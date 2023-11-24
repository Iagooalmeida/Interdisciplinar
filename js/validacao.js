
const handlePhone = (event) => {
    let input = event.target;
    input.value = phoneMask(input.value);
    input.maxLength = 15; // Add maxlength attribute
};

const phoneMask = (value) => {
    if (!value) return "";
    value = value.replace(/\D/g, '');
    value = value.replace(/(\d{2})(\d)/, "($1) $2");
    value = value.replace(/(\d)(\d{4})$/, "$1-$2");
    return value;
};

const handleName = (event) => {
    let input = event.target;
    input.value = nameValidation(input.value);
};

const nameValidation = (value) => {
    if (!value) return "";
    value = value.replace(/[^a-zA-Z\s]/g, '');
    return value;
};

const handlePassword = (event) => {
    let passwordInput = event.target;
    let passwordError = document.getElementById('passwordError');

    // Regras de validação de senha (personalizadas)
    let minLength = 6;
    let hasUpperCase = /[A-Z]/.test(passwordInput.value);
    let hasLowerCase = /[a-z]/.test(passwordInput.value);

    // Limpa mensagens de erro anteriores
    passwordError.innerHTML = '';

    if (passwordInput.value.length < minLength) {
        passwordError.innerHTML += 'A senha deve ter pelo menos 6 caracteres.<br>';
    }
    if (!hasUpperCase) {
        passwordError.innerHTML += 'A senha deve conter pelo menos uma letra maiúscula.<br>';
    }
    if (!hasLowerCase) {
        passwordError.innerHTML += 'A senha deve conter pelo menos uma letra minúscula.<br>';
    }
};

