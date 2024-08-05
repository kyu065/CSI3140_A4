document.addEventListener("DOMContentLoaded", () => {
    // Event listener for client page button
    const goToAdminPageButton = document.getElementById("goToAdminPage");
    if (goToAdminPageButton) {
        goToAdminPageButton.addEventListener("click", () => {
            window.location.href = "index.php";
        });
    }

    const goToClientPageButton = document.getElementById("goToClientPage");
    if (goToClientPageButton) {
        goToClientPageButton.addEventListener("click", () => {
            window.location.href = "client.php";
        });
    }
    
    // Fetches and displays patient data for the admin page
    if (document.querySelector("#patients")) {
        fetch("get_patients.php")
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector("#patients tbody");
                tableBody.innerHTML = ''; // Clears existing rows
                
                data.forEach(patient => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${patient.name}</td>
                        <td>${patient.severity}</td>
                        <td>${patient.wait_time}</td>
                        <td>${patient.code}</td> 
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="${patient.id}">
                                <button type="submit" name="deleteById">Delete</button>
                            </form>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            });
    }
});
