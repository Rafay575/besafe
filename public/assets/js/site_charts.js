
// simple line chart
function lineChart(chartId, dataSetObj, labels) {

    let ctx1 = document.getElementById(chartId).getContext("2d");
    let gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    let commonConfig = {
      tension: 0.4,
      borderWidth: 0,
      pointRadius: 0,
      borderWidth: 3,
      maxBarThickness: 6,
      fill: true,
      backgroundColor: gradientStroke1,
    }
  let dataSet = dataSetObj.map(obj => Object.assign({}, obj, commonConfig));
  let existingChart = Chart.getChart(chartId);

  if (existingChart) {
    existingChart.data.labels = labels;
    existingChart.data.datasets = dataSet;
    existingChart.update();
  } else {
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: labels,
        datasets: dataSet,
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
            position: 'bottom',
            labels: {
              usePointStyle: true // Use point style markers in legend
            }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  }
}
  

// pie chart

function piChart(chartId,data,labels,colors,chartName){
    let ctx4 = document.getElementById(chartId).getContext("2d");
    
    new Chart(ctx4, {
      type: "pie",
      data: {
        labels: labels,
        datasets: [{
          label: chartName,
          weight: 9,
          cutout: 0,
          tension: 0.9,
          pointRadius: 2,
          borderWidth: 2,
          backgroundColor: colors,
          data: data,
          fill: true
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
                display: true,
                 position: 'bottom'
              
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false,
            }
          },
        },
      },
    });
}
  


function barChart(chartId, chartName, barType, labels, data, color = '#3A416F') {
  let ctx6 = document.getElementById(chartId).getContext("2d");

  // Check if the chart with the given chartId already exists
  let existingChart = Chart.getChart(chartId);

  // If the existing chart exists, destroy it before creating a new chart
  if (existingChart) {
    existingChart.destroy();
  }

  new Chart(ctx6, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [{
        label: chartName,
        weight: 5,
        borderWidth: 0,
        borderRadius: 4,
        backgroundColor: color,
        data: data,
        fill: false
      }],
    },
    options: {
      indexAxis: barType,
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          position: 'bottom'
        }
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#9ca2b7'
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: true,
            drawTicks: true,
          },
          ticks: {
            display: true,
            color: '#9ca2b7',
            padding: 10
          }
        },
      },
    },
  });
}
