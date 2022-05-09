$(document).ready(function(){
    var options = {
        responsive: false
    };
    new Chart($("#canvas1"), {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: {
            labels: [
                "Bajas",
                "K/D",
                "Victorias",
                "Derrotas",
                "Horas Jugadas",
                "Rango de Competitivo"
            ],
            datasets: [{
                data: [34.749,2.34, 947, 51, 785, 7],
                backgroundColor: [
                    "#68beff",
                    "#dd74ff",
                    "#ff7070",
                    "#44deb9",
                    "#ffedb5",
                    "#000000"
                ],
                hoverBackgroundColor: [
                    "#ffffff",
                    "#ffffff",
                    "#ffffff",
                    "#ffffff",
                    "#ffffff",
                    "#ffffff"
                ]
            }]
        },
        options: { responsive: false }
    });
});

