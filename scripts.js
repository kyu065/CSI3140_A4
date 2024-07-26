document.addEventListener("DOMContentLoaded", () => {
    fetch("patients.csv")
        .then(response => response.text())
        .then(data => {
            const rows = data.split("\n").slice(1); // Skip header
            const tableBody = document.querySelector("#patientTable tbody");

            rows.forEach(row => {
                if (row.trim() === "") return; // Skip empty rows
                const [name, severity, waitTime] = row.split(",");
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${name}</td>
                    <td>${severity}</td>
                    <td>${waitTime}</td>
                `;
                tableBody.appendChild(tr);
            });
        });
});
