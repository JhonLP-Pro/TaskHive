function getRandomWarmColor() {
    const red = Math.floor(Math.random() * 56) + 50;    // Red: 50-105 (very dark red)
    const green = Math.floor(Math.random() * 56) + 50;  // Green: 50-105 (very dark green)
    const blue = Math.floor(Math.random() * 50);        // Blue: 0-50 (very dark blue)
    return `rgb(${red}, ${green}, ${blue})`;
}

// Apply the random color to the element
document.addEventListener('DOMContentLoaded', (event) => {
    const elements = document.getElementsByClassName('taskCategorie');
    for (let i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = getRandomWarmColor();
    }
});