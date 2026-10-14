/* ==========================================
   Dashboard charts (User and Admin dashboards)
   Needs Chart.js to be loaded before this file.
   Each chart only runs if its <canvas> is on the page.
   ========================================== */


/* ===== Shared settings for all charts ===== */

// Same font and colors as the rest of the site
Chart.defaults.font.family = "'Poppins', sans-serif";
Chart.defaults.font.size = 12;
Chart.defaults.color = '#6b7280';

const indigo = '#4f46e5';
const gridColor = '#eef0f4';
const axisColor = '#d1d5db';

// Show numbers as money, for example 1200 -> $1,200
function money(value) {
    return '$' + Number(value).toLocaleString();
}

// Tooltip style used by all charts
const tooltip = {
    backgroundColor: '#1e1b4b',
    padding: 10,
    cornerRadius: 8,
    displayColors: false,
    callbacks: {
        label: function (context) {
            return money(context.raw);   // raw = the number from the data list
        }
    }
};



/* ===== User dashboard ===== */
/* NOTE: the numbers below are sample data for the design.
   They will come from the database in the next steps. */

// ----- Daily spending (columns) -----
const dailyChart = document.getElementById('dailyChart');

if (dailyChart) {
    new Chart(dailyChart, {
        type: 'bar',
        data: {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14'],
            datasets: [{
                data: [45, 120, 30, 0, 85, 160, 40, 75, 20, 28.75, 62.5, 120, 45, 84.2],
                backgroundColor: indigo,
                hoverBackgroundColor: '#312e81',
                borderRadius: 4,
                borderSkipped: 'start',   // round only the top, flat at the bottom
                maxBarThickness: 24
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    ...tooltip,
                    callbacks: {
                        title: function (items) { return 'October ' + items[0].label; },
                        label: function (context) { return money(context.raw); }
                    }
                }
            },
            scales: {
                x: { grid: { display: false }, border: { color: axisColor } },
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    border: { display: false },
                    ticks: { callback: money, maxTicksLimit: 5 }
                }
            }
        }
    });
}

// ----- Spending by category (horizontal bars) -----
const categoryChart = document.getElementById('categoryChart');

if (categoryChart) {
    new Chart(categoryChart, {
        type: 'bar',
        data: {
            labels: ['Food', 'Bills', 'Travel', 'Health', 'Other'],
            datasets: [{
                data: [420, 360, 230, 128.5, 110],
                // Each category always keeps the same color
                backgroundColor: ['#eb6834', '#eda100', '#2a78d6', '#1baf7a', '#e87ba4'],
                borderRadius: 4,
                borderSkipped: 'start',   // round only the end of the bar
                maxBarThickness: 22
            }]
        },
        options: {
            indexAxis: 'y',   // makes the bars horizontal
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: tooltip
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    border: { display: false },
                    ticks: { callback: money, maxTicksLimit: 4 }
                },
                y: {
                    grid: { display: false },
                    border: { color: axisColor },
                    ticks: { color: '#374151', font: { weight: 500 } }
                }
            }
        }
    });
}

// ----- Last 6 months (line) -----
const monthlyChart = document.getElementById('monthlyChart');

if (monthlyChart) {
    new Chart(monthlyChart, {
        type: 'line',
        data: {
            labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                data: [1650, 1820, 1540, 1910, 1420, 1248.5],
                borderColor: indigo,
                borderWidth: 2,
                backgroundColor: 'rgba(79, 70, 229, 0.1)',   // light fill under the line
                fill: true,
                tension: 0.35,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: indigo,
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },   // tooltip shows when hovering near a month
            plugins: {
                legend: { display: false },
                tooltip: tooltip
            },
            scales: {
                x: { grid: { display: false }, border: { color: axisColor } },
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    border: { display: false },
                    ticks: { callback: money, maxTicksLimit: 5 }
                }
            }
        }
    });
}



/* ===== Admin dashboard ===== */
/* NOTE: the numbers below are sample data for the design.
   They will come from the database in the next steps. */

// Tooltip for counts (users, expenses), not money
const countTooltip = {
    ...tooltip,
    callbacks: {
        label: function (context) {
            return Number(context.raw).toLocaleString();
        }
    }
};

// ----- New users per month (columns) -----
const adminUsersChart = document.getElementById('adminUsersChart');

if (adminUsersChart) {
    new Chart(adminUsersChart, {
        type: 'bar',
        data: {
            labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                data: [42, 58, 51, 77, 88, 96],
                backgroundColor: indigo,
                hoverBackgroundColor: '#312e81',
                borderRadius: 4,
                borderSkipped: 'start',   // round only the top, flat at the bottom
                maxBarThickness: 24
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: countTooltip
            },
            scales: {
                x: { grid: { display: false }, border: { color: axisColor } },
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    border: { display: false },
                    ticks: { maxTicksLimit: 5 }
                }
            }
        }
    });
}

// ----- Top categories, all users (horizontal bars) -----
const adminCategoryChart = document.getElementById('adminCategoryChart');

if (adminCategoryChart) {
    new Chart(adminCategoryChart, {
        type: 'bar',
        data: {
            labels: ['Food', 'Bills', 'Travel', 'Health', 'Other'],
            datasets: [{
                data: [18400, 15200, 9800, 5400, 4100],
                // Same colors as the user dashboard, so a category always looks the same
                backgroundColor: ['#eb6834', '#eda100', '#2a78d6', '#1baf7a', '#e87ba4'],
                borderRadius: 4,
                borderSkipped: 'start',   // round only the end of the bar
                maxBarThickness: 22
            }]
        },
        options: {
            indexAxis: 'y',   // makes the bars horizontal
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: tooltip
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    border: { display: false },
                    ticks: {
                        maxTicksLimit: 4,
                        // Short money labels, for example 10000 -> $10K
                        callback: function (value) { return '$' + (value / 1000) + 'K'; }
                    }
                },
                y: {
                    grid: { display: false },
                    border: { color: axisColor },
                    ticks: { color: '#374151', font: { weight: 500 } }
                }
            }
        }
    });
}

// ----- Expenses added per day (line) -----
const adminActivityChart = document.getElementById('adminActivityChart');

if (adminActivityChart) {
    new Chart(adminActivityChart, {
        type: 'line',
        data: {
            labels: ['Thu', 'Fri', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed'],
            datasets: [{
                data: [84, 97, 120, 132, 78, 64, 67],
                borderColor: indigo,
                borderWidth: 2,
                backgroundColor: 'rgba(79, 70, 229, 0.1)',   // light fill under the line
                fill: true,
                tension: 0.35,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: indigo,
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },   // tooltip shows when hovering near a day
            plugins: {
                legend: { display: false },
                tooltip: countTooltip
            },
            scales: {
                x: { grid: { display: false }, border: { color: axisColor } },
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor },
                    border: { display: false },
                    ticks: { maxTicksLimit: 5 }
                }
            }
        }
    });
}
