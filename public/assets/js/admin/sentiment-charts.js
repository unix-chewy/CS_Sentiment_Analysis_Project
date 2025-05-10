$(document).ready(function() {
    // Initialize chart contexts
    const sentimentPieCtx = document.getElementById('sentimentChart');
    const sentimentTrendCtx = document.getElementById('reviewTrendChart');
    const categoryCtx = document.getElementById('categoryChart');

    // Filters
    const positiveFilter = document.getElementById('positive-filter');
    const neutralFilter = document.getElementById('neutral-filter');
    const negativeFilter = document.getElementById('negative-filter');

    // Fetch data on load and on filter change
    [positiveFilter, neutralFilter, negativeFilter].forEach(f => f.addEventListener('change', fetchChartData));
    fetchChartData();

    function fetchChartData() {
        const activeFilters = [];
        if (positiveFilter.checked) activeFilters.push('positive');
        if (neutralFilter.checked) activeFilters.push('neutral');
        if (negativeFilter.checked) activeFilters.push('negative');

        fetch('/CS_Sentiment_Analysis_Project/app/controllers/admin/fetch-chart-data.php')
            .then((response) =>{
               return response.json();
            })

            .then(data => {
                console.log('Received data:', data);
                
                // Sentiment pie chart
                const filtered = data.sentiments.filter(s => activeFilters.includes(s.sentiment_label));
                createSentimentChart(filtered, 'pie', sentimentPieCtx);
                
                // Category chart
                createCategoryChart(data.categories, categoryCtx);
                
                // Sentiment trends over time chart
               createSentimentTrendChart(data.sentiment_trends, sentimentTrendCtx);
            })  
    }

    function createSentimentChart(chartData, type, ctx) {
        if (ctx.chart) ctx.chart.destroy();
        
        const positive = chartData.filter(item => item.sentiment_label === 'positive').length;
        const neutral = chartData.filter(item => item.sentiment_label === 'neutral').length;
        const negative = chartData.filter(item => item.sentiment_label === 'negative').length;

        ctx.chart = new Chart(ctx, {
            type: type,
            data: {
                labels: ['Positive', 'Neutral', 'Negative'],
                datasets: [{
                    label: '# of responses',
                    data: [positive, neutral, negative],
                    backgroundColor: ['#ff6633', '#cccccc', '#f53d2d'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    function createCategoryChart(catData, ctx) {
        if (ctx.chart) ctx.chart.destroy();
        
        ctx.chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: catData.map(x => x.product_category),
                datasets: [{
                    label: 'Reviews',
                    data: catData.map(x => x.count),
                    backgroundColor: '#ff6633',
                    borderColor: '#cc5229',
                    hoverBackgroundColor: '#f53d2d',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
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
    }

    function createSentimentTrendChart(trendData, ctx) {
        if (ctx.chart) ctx.chart.destroy();
        
        const months = [...new Set(trendData.map(r => r.month))].sort();
        const sentiments = ['positive', 'neutral', 'negative'];
        
        const datasets = sentiments.map(label => {
            const dataPoints = months.map(m => {
                const rec = trendData.find(r => r.month === m && r.sentiment_label === label);
                return rec ? rec.review_count : 0;
            });
            
            return {
                label: label.charAt(0).toUpperCase() + label.slice(1),
                data: dataPoints,
                borderColor: getColor(label),
                backgroundColor: 'rgba(0,0,0,0)',
                tension: 0.3
            };
        });
        
        ctx.chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Sentiment Trends Over Time'
                    },
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Reviews'
                        },
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }
    
    function getColor(label) {
        return {
            positive: '#ff6633',
            neutral: '#cccccc',
            negative: '#f53d2d'
        }[label];
    }
});