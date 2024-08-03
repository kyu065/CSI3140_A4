document.addEventListener("DOMContentLoaded", () => {
    fetchPatients();

    document.querySelector("#goToClientPage").addEventListener("click", () => {
        window.location.href = "client.php";
    });

    document.querySelector("#goToAdminPage").addEventListener("click", () => {
        window.location.href = "admin.php";
    });
});

function fetchPatients() {
    fetch("get_patients.php")
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#patients tbody");
            tableBody.innerHTML = ''; // Clear existing rows

            data.forEach(patient => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${patient.name}</td>
                    <td>${patient.severity}</td>
                    <td>${patient.wait_time}</td>
                    <td><button class="delete-btn" data-id="${patient.id}">Delete</button></td>
                `;
                tableBody.appendChild(tr);
            });

            // Attach event listeners to delete buttons
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", (event) => {
                    const patientId = event.target.dataset.id;
                    fetch("delete_patient.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ id: patientId })
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            fetchPatients(); // Refresh the table data
                        } else {
                            console.error('Error deleting patient:', result.error);
                        }
                    });
                });
            });
        })
        .catch(error => console.error('Error fetching patient data:', error));
}
