const API_BASE_URL = '/api';
const API_LOGIN = '/login';
const API_SOLDERED_PCB = '/soldered_printed_circuit_boards';

window.token = null;
window.email = null;

let loginCard = document.getElementById('login-card');
let loginForm = document.getElementById('login-form');
let monitorCard = document.getElementById('monitor-card');
let dropdown = document.getElementById('user-dropdown-menu');
let pcbSerialNumber = document.getElementById('pcb-serial-number');
let pcbModelName = document.getElementById('pcb-model-name');
let pcbCost = document.getElementById('pcb-cost');
let pcbExitDatetime = document.getElementById('pcb-exit-datetime');
let pcbDescription = document.getElementById('pcb-description');
let pcbOverlimitTemperatures = document.getElementById('pcb-overlimit-temps');
let pcbListGroup = document.getElementById('pcb-list-group');
let timer = null;
let interval = 1000;

function updateDropdown() {
    dropdown.innerHTML = '';

    if (window.email) {
        let dropdownEmail = document.createElement('li');
        dropdownEmail.classList.add('dropdown-item');
        dropdownEmail.innerHTML = window.email;

        let dropdownLogoutLink = document.createElement('a');
        dropdownLogoutLink.href = '#';
        dropdownLogoutLink.onclick = logout;
        dropdownLogoutLink.innerHTML = 'Logout';
        dropdownLogoutLink.classList.add('dropdown-item');

        let dropdownLogout = document.createElement('li');
        dropdownLogout.appendChild(dropdownLogoutLink);

        dropdown.appendChild(dropdownEmail);
        dropdown.appendChild(dropdownLogout);
    } else {
        let dropdownDefault = document.createElement('li');
        dropdownDefault.classList.add('dropdown-item');
        dropdownDefault.innerHTML = 'Please login first';

        dropdown.appendChild(dropdownDefault);
    }
}

function showPCB(pcb) {
    let exitDatetime = new Date(pcb.exitDatetime);
    let overlimitTemperatures = pcb.preheatPhaseOverLimitTemperatures + pcb.reflowPhaseOverLimitTemperatures + pcb.coolingPhaseOverLimitTemperatures;

    pcbSerialNumber.innerHTML = pcb.serialNumber;
    pcbModelName.innerHTML = pcb.printedCircuitBoard.name;
    pcbCost.innerHTML = `&euro;${pcb.printedCircuitBoard.cost}`;
    pcbExitDatetime.innerHTML = `${exitDatetime.toLocaleDateString('it-IT')} ${exitDatetime.toLocaleTimeString('it-IT')}`;
    pcbDescription.innerHTML = pcb.printedCircuitBoard.description ? pcb.printedCircuitBoard.description : 'No description';
    pcbOverlimitTemperatures.innerHTML = overlimitTemperatures;
    pcbOverlimitTemperatures.className = 'badge rounded-pill';
    pcbOverlimitTemperatures.classList.add(
        overlimitTemperatures > 20 ? 'bg-danger' : (overlimitTemperatures > 10 ? 'bg-warning' : 'bg-secondary')
    );
}

function onclickPCB(event) {
    let serialNumber = event.target.getAttribute('data-serial-number'); 
    loadPCB(serialNumber);
}

async function loadPCB(serialNumber) {
    await axios.get(`${API_BASE_URL}${API_SOLDERED_PCB}/${serialNumber}`, getHeaders()).then((response) => {
        showPCB(response.data);
    }, (error) => {
        console.log(error);
    });
}

function showList(pcbs) {
    pcbListGroup.innerHTML = '';

    pcbs.forEach(pcb => {
        let pcbListItem = document.createElement('li');

        pcbListItem.classList.add('list-group-item');
        pcbListItem.classList.add('list-group-item-action');
        pcbListItem.innerHTML = `${pcb.printedCircuitBoard.name} - <code>${pcb.serialNumber}</code>`;
        pcbListItem.setAttribute('data-serial-number', pcb.serialNumber);
        pcbListItem.onclick = onclickPCB;

        pcbListGroup.appendChild(pcbListItem);
    });
}

function showLogin() {
    loginCard.classList.remove('d-none');
    monitorCard.classList.add('d-none');
}

function showMonitorCard() {
    loginCard.classList.add('d-none');
    monitorCard.classList.remove('d-none');
}

async function login({ email, password }) {
    await axios.post(`${API_BASE_URL}${API_LOGIN}`, {
        email: email,
        password: password
    }).then((response) => {
        window.token = response.data.token;
        window.email = email;

        showMonitorCard();
        updateDropdown();

        loadPCBs(true);
        timer = setInterval(loadPCBs, 5000);
    }, (error) => {
        console.log(error);
    });
}

function logout() {
    window.token = null;
    window.email = null;

    clearInterval(timer);

    showLogin();
    updateDropdown();
}

async function loadPCBs(showFirstPCB) {
    await axios.get(`${API_BASE_URL}${API_SOLDERED_PCB}`, getHeaders()).then((response) => {
        showList(response.data);

        if (showFirstPCB)
            loadPCB(response.data[0].serialNumber);

    }, (error) => {
        console.log(error);
        if (error.response.status == 401)
            logout();
    });
}

function getHeaders() {
    return {
        headers: {
            Authorization: `Bearer ${window.token}`,
            Accept: 'application/json'
        }
    };
}

loginForm.onsubmit = async function(event) {
    event.preventDefault();

    login({
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    });

    document.getElementById('email').value = '';
    document.getElementById('password').value = '';
};

updateDropdown();
showLogin();