document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('ratings-by-user-chart').getContext('2d');
 
    const userLabels = ['Alpha', 'Beta', 'Charlie', 'Delta', 'Etits'];
    const ratingCounts = [25, 40, 12, 30, 18]; // dummy data
 
    new Chart(ctx, {
       type: 'bar',
       data: {
          labels: userLabels,
          datasets: [{
             label: 'Total Ratings Given',
             data: ratingCounts,
             backgroundColor: '#ff6633', 
             borderColor: '#cc5229', 
             hoverBackgroundColor: '#f53d2d', 
             borderWidth: 1
          }]
       },
       options: {
          responsive: true,
          scales: {
             y: {
                beginAtZero: true,
                ticks: {
                   precision: 0
                }
             }
          }
       }
    });
 });
 