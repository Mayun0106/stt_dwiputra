

import Alpine from 'alpinejs';
import {
    Chart,
    CategoryScale,
    LinearScale,
    BarElement,
    PointElement,
    LineElement,
    LineController,
    BarController,
    Tooltip,
    Legend,
    Filler,
    Title,
} from 'chart.js';

Chart.register(
    CategoryScale,
    LinearScale,
    BarElement,
    PointElement,
    LineElement,
    LineController,
    BarController,
    Tooltip,
    Legend,
    Filler,
    Title,
);

window.Chart = Chart;
window.Alpine = Alpine;

Alpine.start();
