import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import { Chart, registerables } from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';
import SignaturePad from 'signature_pad';

// Register Chart.js components
Chart.register(...registerables);
Chart.register(ChartDataLabels);

window.Alpine = Alpine;
window.Swal = Swal;
window.Chart = Chart;
window.ChartDataLabels = ChartDataLabels;
window.SignaturePad = SignaturePad;

Alpine.start();
