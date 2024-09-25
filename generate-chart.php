<?php
// Define AI moves data directly
$aiMoves = [
    [1, -5], // Example AI move data: [moveIndex, score]
    [2, -5],
    [3, -5],
    [4, 0],
    [5, -5],
    [6, -5],
    [7, -5],
    [8, -5]
    // Add more AI move data as needed
];

// Merge player moves and AI moves into a single array

// Generate chart using a PHP charting library like Chart.js or Google Charts
// Example: Echo JavaScript to generate a line graph using Chart.js
echo "
<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
<canvas id='myChart' width='400' height='400'></canvas>
<script>
var aiMoves = " . json_encode($aiMoves) . "; // AI moves data

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line', // Change chart type to line graph
    data: {
        labels: aiMoves.map(move => move[0]), // Use AI move indices as X-axis labels
        datasets: [{
            label: 'AI Move Scores',
            data: aiMoves.map(move => move[1]), // Use AI move scores as Y-axis data
            borderColor: 'rgb(255, 99, 132)', // Line color
            fill: false, // Do not fill the area under the line
            pointRadius: 5, // Size of data points
            pointBackgroundColor: 'rgb(255, 99, 132)', // Color of data points
            pointHoverRadius: 7 // Size of data points on hover
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'AI Moves' // Label for X-axis
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Scores' // Label for Y-axis
                },
                beginAtZero: true // Start Y-axis from 0
            }
        }
    }
});
</script>
";
?>
