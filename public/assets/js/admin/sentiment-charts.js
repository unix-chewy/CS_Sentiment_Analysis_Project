$(document).ready(function() {
    // Initialize DataTable
    
const sentimentPieCtx = document.getElementById('sentimentChart');
const sentimentLineCtx = document.getElementById('trendChart');

fetch('/CS_Sentiment_Analysis_Project/app/controllers/admin/fetch-chart-data.php')

.then((response) => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
})
.then((data) => {
    console.log('Received data:', data);
    createChart(data, 'pie', sentimentPieCtx);
    createChart(data, 'line', sentimentLineCtx);
})

function createChart(chartData, type, ctx) {
  // Count sentiments
  const positive = chartData.filter(item => item.sentiment_label === 'positive').length;
  const neutral = chartData.filter(item => item.sentiment_label === 'neutral').length;
  const negative = chartData.filter(item => item.sentiment_label === 'negative').length;

  new Chart(ctx, {
    type: type,
    data: {
      labels: ['Positive', 'Neutral', 'Negative'],
      datasets: [{
        label: '# of responses',
        data: [positive, neutral, negative],
        backgroundColor: ['#28a745', '#6c757d', '#dc3545'], // Green for positive, Gray for neutral, Red for negative
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom'
        },
      }
    }
  });
}

});


