 let exerciseIndex = 1;


// Hämta HTML-elementen
const addExerciseButton = document.getElementById("add-exercise");
const exerciseContainer = document.getElementById("exercise-container");


// Kontrollera att knappen finns på sidan
if (addExerciseButton && exerciseContainer) {

    // Lyssna efter klick på knappen
    addExerciseButton.addEventListener("click", function() {

        // Skapa ett nytt div-element
        const newExercise = document.createElement("div");

        // Ge elementet en klass
        newExercise.classList.add("exercise-item");


        // Lägg till HTML-innehåll
        newExercise.innerHTML = `
            <hr>

            <h2>Ny övning</h2>

            <label>Välj övning:</label>

            <select name="exercises[${exerciseIndex}][exercise_id]" required>

                <option value="">Välj en övning</option>

                ${exerciseOptions}

            </select>
        `;


        // Lägg till den nya övningen i behållaren
        exerciseContainer.appendChild(newExercise);


        // Öka numreringen
        exerciseIndex++;

    });

}