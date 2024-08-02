document.addEventListener("DOMContentLoaded", () => {
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
                `;
                tableBody.appendChild(tr);
            });
        })
        .catch(error => console.error('Error fetching patient data:', error));
});

