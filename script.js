function submitForm() {
    const name = document.getElementById('name').value;
    const age = document.getElementById('age').value;
    const batch = document.getElementById('batch').value;

    // Validate age
    if (age < 18 || age > 65) {
        alert('Age must be between 18 and 65.');
        return;
    }
    if (name === "") {
        alert("Please enter your name");
        return false;
    }

    if (batch === "") {
        alert("Please select a batch");
        return false;
    }
}
