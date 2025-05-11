$(document).ready(function() {
    const mostRatedProductsCtx = document.getElementById('mostRatedProducts');

    // Fetch data on load
    fetchChartData();

    function fetchChartData() {
        fetch('/CS_Sentiment_Analysis_Project/app/controllers/admin/fetch-chart-data.php')
            .then(response => response.json())
            .then(data => {
                createMostRatedProductsChart(data.most_rated_products, mostRatedProductsCtx);
            });
    }

    function createMostRatedProductsChart(prodData, ctx) {
        if (ctx.chart) ctx.chart.destroy();

        const top3 = prodData
            .sort((a, b) => b.review_count - a.review_count)
            .slice(0, 3);

        const labels = top3.map(p => p.product_name);
        const values = top3.map(p => p.review_count);

        ctx.chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Review Count',
                    data: values,
                    backgroundColor: ['#ff6633', '#cccccc', '#f53d2d'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Top 3 Most Rated Products'
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
});
