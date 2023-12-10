document.addEventListener("DOMContentLoaded", function () {
//     function fetchContactDetails() {
//         return {
//             assignedTo: "Jane Doe",
//             contactType: "Support",
//         };
//     }

    function addNoteToSection(comment) {
        const notesSection = document.querySelector(".notes div");
        const newNote = document.createElement("div");
        newNote.innerHTML = `<h3>${fetchContactDetails().assignedTo}</h3><p>${comment}</p>`;
        notesSection.appendChild(newNote);
    }

    // Assign to Me button click event
    document.getElementById("assign-to").addEventListener("click", function () {
        console.log("Assigning to me");
    });

    // Switch Type button click event
    document.getElementById("switch").addEventListener("click", function () {
        // Simulate switching the contact type
        console.log("Switching contact type");
    });

    // New Note Form submission event
    document.getElementById("new-note-form").addEventListener("submit", function (event) {
        event.preventDefault();
        const noteComment = document.getElementById("note-comment").value;
        
        if (noteComment.trim() !== "") {
            // Simulate adding the note
            addNoteToSection(noteComment);
            // Clear the note input field
            document.getElementById("note-comment").value = "";
        }
    });
});
