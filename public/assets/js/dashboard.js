document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('emailsChart');
    if (!canvas || typeof Chart === 'undefined') {
        return;
    }

    const sent = Number(canvas.dataset.sent || 0);
    const remaining = Number(canvas.dataset.remaining || 0);

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: ['Envoyés', 'Restants'],
            datasets: [{
                label: 'Emails',
                data: [sent, remaining],
                backgroundColor: ['#198754', '#cfead9']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
});
