document.getElementById('type').addEventListener('input', validateType);
document.getElementById('brand').addEventListener('input', validateBrand);
document.getElementById('checkButton').addEventListener('click', checkDatabase);

function validateType() {
}

function validateBrand() {
}

function checkDatabase() {
    const typeInput = document.getElementById('type').value;
    const brandInput = document.getElementById('brand').value;

    fetch(`task04.php?type=${encodeURIComponent(typeInput)}&brand=${encodeURIComponent(brandInput)}`)
        .then(response => response.json())
        .then(data => {
            const typeMessage = document.getElementById('type-message');
            const brandMessage = document.getElementById('brand-message');

            typeMessage.textContent = data.typeMessage;
            typeMessage.className = data.typeMessage.includes('valid') ? 'validation-message success-message' : 'validation-message error-message';

            brandMessage.textContent = data.brandMessage;
            brandMessage.className = data.brandMessage.includes('valid') ? 'validation-message success-message' : 'validation-message error-message';
        })
        .catch(error => console.error('Error:', error));
}
