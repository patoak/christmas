// Example of capturing the form submission data
function displayFormData() {
    const name = document.getElementById('name').value;
    const surname = document.getElementById('surname').value;
    const letter = document.getElementById('letter').value;
    const gifts = document.querySelectorAll('input[name="gifts"]:checked');

    let selectedGifts = [];
    gifts.forEach(gift => selectedGifts.push(gift.value));

    console.log("Vārds: " + name);
    console.log("Uzvārds: " + surname);
    console.log("Vēstules teksts: " + letter);
    console.log("Izvēlētās dāvanas: " + selectedGifts.join(", "));
}
