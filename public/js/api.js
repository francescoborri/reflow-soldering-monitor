const API_BASE_URL = '/api';
const API_LOGIN = '/login';
const API_SOLDERED_PCBS = '/soldered_printed_circuit_boards';

let loginCard = document.getElementById('login-card');
let monitorCard = document.getElementById('monitor-card');

async function monitor() {
    let response = await axios.get(`${API_BASE_URL}${API_SOLDERED_PCBS}`, { params: { page: 1 } });
}

function login(email, password) {
    let response = await axios.post(`${API_BASE_URL}${API_LOGIN}`, {
        email: email,
        password: password
    });

    sessionStorage.setItem('token', response.data.token);

    loginCard.classList.add('d-none');
    monitorCard.classList.remove('d-none');
}

function logout() {
    sessionStorage.removeItem('token');
    monitorCard.innerHTML = '';

    loginCard.classList.remove('d-none');
    monitorCard.classList.add('d-none');
}

function main() {
    let interval = setInterval(function () {
        clearInterval(interval);
    }, 10000);
}

document.getElementById('login-form').onsubmit = async function (event) {
    event.preventDefault();

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    login(email, password);    
};