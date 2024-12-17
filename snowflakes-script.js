// Function to generate snowflakes
function createSnowflakes() {
    const snowflakesContainer = document.getElementById('snowflakes-container');
    const numberOfSnowflakes = 150; // Adjust number of snowflakes

    // Loop to create multiple snowflakes
    for (let i = 0; i < numberOfSnowflakes; i++) {
        const snowflake = document.createElement('div');
        snowflake.classList.add('snowflake');
        snowflake.innerHTML = '❄'; // Snowflake symbol

        // Random horizontal position (left) and size (font-size)
        snowflake.style.left = `${Math.random() * 100}vw`; 
        snowflake.style.fontSize = `${Math.random() * 10 + 10}px`; // Random size between 10px and 20px

        // Random falling speed (animation duration) and delay for continuous falling
        snowflake.style.animationDuration = `${Math.random() * 5 + 5}s`; // Random fall speed between 5s and 10s


        // Append snowflake to container
        snowflakesContainer.appendChild(snowflake);
    }
}

// Call the function to create snowflakes
createSnowflakes();
