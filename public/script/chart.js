// // Admin Total
// var currentDate = new Date();

// var monthNames = [
//   "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
//   "Agustus", "September", "Oktober", "November", "Desember"
// ];

// var currentMonthIndex = currentDate.getMonth();

// var labels = [];

// for (var i = 0; i <= currentMonthIndex; i++) {
//   labels.push(monthNames[i]);
// }

// var ctxL = document.getElementById("adminT").getContext('2d');
// var myLineChart = new Chart(ctxL, {
//   type: 'line',
//   data: {
//     labels: labels,
//     datasets: [{
//       label: "Total Poin",
//       data: [65, 59, 80, 81, 56, 55, 40],
//       backgroundColor: [
//         'rgba(105, 0, 132, .2)',
//       ],
//       borderColor: [
//         'rgba(200, 99, 132, .7)',
//       ],
//       borderWidth: 2,
//       fill: false,
//     },
//     ]
//   },
//   options: {
//     responsive: true
//   }
// });

// Admin Perbandingan
new Chart(document.getElementById("adminP"), {
  "type": "horizontalBar",
  "data": {
    "labels": ["Rerata Poin Seluruh Karyawan", "Rerata Poin Seluruh Bidang", "Rerata Poin Seluruh BKPH", "Rerata Poin Seluruh KRPH", "Rerata Poin Seluruh Asper/KBKPH"],
    "datasets": [{
      "label": "Total Poin",
      "data": [22, 33, 55, 12, 86, 23],
      "fill": false,
      "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
        "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
      ],
      "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
        "rgb(75, 192, 192)", "rgb(54, 162, 235)"
      ],
      "borderWidth": 1
    }]
  },
  "options": {
    "scales": {
      "xAxes": [{
        "ticks": {
          "beginAtZero": true
        }
      }]
    }
  }
});

// Perbandingan Bulan
function extractTableData() {
  const table = document.getElementById('harian');
  const dataRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

  console.log(dataRows);
}

extractTableData();



// var currentDate = new Date();

// var monthNames = [
//   "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
//   "Agustus", "September", "Oktober", "November", "Desember"
// ];

// var currentMonthIndex = currentDate.getMonth();

// var labels = [];

// for (var i = 0; i <= currentMonthIndex; i++) {
//   labels.push(monthNames[i]);
// }

// new Chart(document.getElementById('barChart'), {
//   type: 'bar',
//   data: {
//     labels: labels,
//     datasets: [{
//       label: '# of Votes',
//       data: [12, 19, 3, 5, 2, 3],
//       backgroundColor: [
//         'rgba(255, 99, 132, 0.2)',
//         'rgba(54, 162, 235, 0.2)',
//         'rgba(255, 206, 86, 0.2)',
//         'rgba(75, 192, 192, 0.2)',
//         'rgba(153, 102, 255, 0.2)',
//         'rgba(255, 159, 64, 0.2)'
//       ],
//       borderColor: [
//         'rgba(255,99,132,1)',
//         'rgba(54, 162, 235, 1)',
//         'rgba(255, 206, 86, 1)',
//         'rgba(75, 192, 192, 1)',
//         'rgba(153, 102, 255, 1)',
//         'rgba(255, 159, 64, 1)'
//       ],
//       borderWidth: 1,
//     }],
//   },
// });


    // // Mendapatkan nilai grandTotal dari tabel #harian di datatables
    // var grandTotal = $('#harian tfoot th:last').text();

    // // Buat label
    // var labels = ['Total'];

    // // Buat grafik batang (bar chart) menggunakan Chart.js
    // new Chart(document.getElementById('barChart'), {
    //     type: 'bar',
    //     data: {
    //         labels: labels,
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [grandTotal], // Gunakan nilai grandTotal sebagai data
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255,99,132,1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1,
    //         }],
    //     },
    // });




// // Get the table data
// const table = document.getElementById('harian');
// const tbody = table.querySelector('tbody');
// const rows = tbody.querySelectorAll('tr');

// // Initialize arrays to store data
// const labels = [];
// const data = [];

// // Iterate over rows to extract data
// rows.forEach(row => {
//     const columns = row.querySelectorAll('td');
//     const nama = columns[0].textContent.trim();
//     const total = parseInt(columns[columns.length - 1].textContent);

//     labels.push(nama);
//     data.push(total);
// });

// // Create the chart
// const ctx = document.getElementById('barChart').getContext('2d');
// const barChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: labels,
//         datasets: [{
//             label: 'Total',
//             data: data,
//             backgroundColor: 'rgba(54, 162, 235, 0.2)',
//             borderColor: 'rgba(54, 162, 235, 1)',
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });

//     var currentDate = new Date();

// var monthNames = [
//   "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
//   "Agustus", "September", "Oktober", "November", "Desember"
// ];

// var currentMonthIndex = currentDate.getMonth();

// var labels = [];

// for (var i = 0; i <= currentMonthIndex; i++) {
//   labels.push(monthNames[i]);
// }

// // Get the table data
// const table = document.getElementById('harian');
// const tbody = table.querySelector('tbody');
// const rows = tbody.querySelectorAll('tr');

// // Initialize arrays to store data
// const data = [];

// // Iterate over rows to extract data
// rows.forEach(row => {
//     const columns = row.querySelectorAll('td');
//     const total = parseInt(columns[columns.length - 1].textContent.trim());
//     data.push(total);
// });

// new Chart(document.getElementById('barChart'), {
//   type: 'bar',
//   data: {
//     labels: labels,
//     datasets: [{
//       label: 'Total',
//       data: data,
//       backgroundColor: 'rgba(54, 162, 235, 0.2)',
//       borderColor: 'rgba(54, 162, 235, 1)',
//       borderWidth: 1
//     }]
//   },
//   options: {
//     scales: {
//       yAxes: [{
//         ticks: {
//           beginAtZero: true
//         }
//       }]
//     }
//   }
// });


// Pimpinan Total
var ctxL = document.getElementById("pimpinanT").getContext('2d');
var myLineChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
      label: "My First dataset",
      data: [65, 59, 80, 81, 56, 55, 40],
      backgroundColor: [
        'rgba(105, 0, 132, .2)',
      ],
      borderColor: [
        'rgba(200, 99, 132, .7)',
      ],
      borderWidth: 2
    },
    ]
  },
  options: {
    responsive: true
  }
});

// Pimpinan Perbandingan
new Chart(document.getElementById("pimpinanP"), {
  "type": "horizontalBar",
  "data": {
    "labels": ["Rerata Poin Seluruh Karyawan", "Rerata Poin Seluruh Bidang", "Rerata Poin Seluruh BKPH", "Rerata Poin Seluruh KRPH", "Rerata Poin Seluruh Asper/KBKPH"],
    "datasets": [{
      "label": "My First Dataset",
      "data": [22, 33, 55, 12, 86, 23],
      "fill": false,
      "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
        "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
      ],
      "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
        "rgb(75, 192, 192)", "rgb(54, 162, 235)"
      ],
      "borderWidth": 1
    }]
  },
  "options": {
    "scales": {
      "xAxes": [{
        "ticks": {
          "beginAtZero": true
        }
      }]
    }
  }
});

// Karyawan Total
var ctxL = document.getElementById("karyawanT").getContext('2d');
var myLineChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
      label: "My First dataset",
      data: [65, 59, 80, 81, 56, 55, 40],
      backgroundColor: [
        'rgba(105, 0, 132, .2)',
      ],
      borderColor: [
        'rgba(200, 99, 132, .7)',
      ],
      borderWidth: 2
    },
    ]
  },
  options: {
    responsive: true
  }
});

// Karyawan Perbandingan
new Chart(document.getElementById("karyawanP"), {
  "type": "horizontalBar",
  "data": {
    "labels": ["Total Poin Karyawan", "Rerata Poin Seluruh Karyawan"],
    "datasets": [{
      "label": "My First Dataset",
      "data": [22, 33],
      "fill": false,
      "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
      ],
      "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)"
      ],
      "borderWidth": 1
    }]
  },
  "options": {
    "scales": {
      "xAxes": [{
        "ticks": {
          "beginAtZero": true
        }
      }]
    }
  }
});

// Rekap Karyawan
var ctxP = document.getElementById("karyawanChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
  plugins: [ChartDataLabels],
  type: 'pie',
  data: {
    labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
    datasets: [{
      data: [210, 130, 120, 160, 120],
      backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
      hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
    }]
  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
      labels: {
        padding: 20,
        boxWidth: 10
      }
    },
    plugins: {
      datalabels: {
        formatter: (value, ctx) => {
          let sum = 0;
          let dataArr = ctx.chart.data.datasets[0].data;
          dataArr.map(data => {
            sum += data;
          });
          let percentage = (value * 100 / sum).toFixed(2) + "%";
          return percentage;
        },
        color: 'white',
        labels: {
          title: {
            font: {
              size: '16'
            }
          }
        }
      }
    }
  }
});

// Rekap Bidang
var ctxP = document.getElementById("bidangChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
  plugins: [ChartDataLabels],
  type: 'pie',
  data: {
    labels: ["Red", "Green", "Yellow"],
    datasets: [{
      data: [210, 130],
      backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
      hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
    }]
  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
      labels: {
        padding: 20,
        boxWidth: 10
      }
    },
    plugins: {
      datalabels: {
        formatter: (value, ctx) => {
          let sum = 0;
          let dataArr = ctx.chart.data.datasets[0].data;
          dataArr.map(data => {
            sum += data;
          });
          let percentage = (value * 100 / sum).toFixed(2) + "%";
          return percentage;
        },
        color: 'white',
        labels: {
          title: {
            font: {
              size: '16'
            }
          }
        }
      }
    }
  }
});

// Rekap BKPH
var ctxP = document.getElementById("bkphChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
  plugins: [ChartDataLabels],
  type: 'pie',
  data: {
    labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
    datasets: [{
      data: [210, 130, 120, 160, 120],
      backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
      hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
    }]
  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
      labels: {
        padding: 20,
        boxWidth: 10
      }
    },
    plugins: {
      datalabels: {
        formatter: (value, ctx) => {
          let sum = 0;
          let dataArr = ctx.chart.data.datasets[0].data;
          dataArr.map(data => {
            sum += data;
          });
          let percentage = (value * 100 / sum).toFixed(2) + "%";
          return percentage;
        },
        color: 'white',
        labels: {
          title: {
            font: {
              size: '16'
            }
          }
        }
      }
    }
  }
});

// Rekap KRPH
var ctxP = document.getElementById("krphChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
  plugins: [ChartDataLabels],
  type: 'pie',
  data: {
    labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
    datasets: [{
      data: [210, 130, 120, 160, 120],
      backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
      hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
    }]
  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
      labels: {
        padding: 20,
        boxWidth: 10
      }
    },
    plugins: {
      datalabels: {
        formatter: (value, ctx) => {
          let sum = 0;
          let dataArr = ctx.chart.data.datasets[0].data;
          dataArr.map(data => {
            sum += data;
          });
          let percentage = (value * 100 / sum).toFixed(2) + "%";
          return percentage;
        },
        color: 'white',
        labels: {
          title: {
            font: {
              size: '16'
            }
          }
        }
      }
    }
  }
});

// Rekap Asper/KBKPH
var ctxP = document.getElementById("asperChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
  plugins: [ChartDataLabels],
  type: 'pie',
  data: {
    labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
    datasets: [{
      data: [210, 130, 120, 160, 120],
      backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
      hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
    }]
  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
      labels: {
        padding: 20,
        boxWidth: 10
      }
    },
    plugins: {
      datalabels: {
        formatter: (value, ctx) => {
          let sum = 0;
          let dataArr = ctx.chart.data.datasets[0].data;
          dataArr.map(data => {
            sum += data;
          });
          let percentage = (value * 100 / sum).toFixed(2) + "%";
          return percentage;
        },
        color: 'white',
        labels: {
          title: {
            font: {
              size: '16'
            }
          }
        }
      }
    }
  }
});