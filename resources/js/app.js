import './bootstrap';
import Alpine from 'alpinejs';
import jQuery, { event } from 'jquery';
import 'filepond/dist/filepond.min.css';
import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';


import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css';


window.Swiper = Swiper;
window.Navigation = Navigation;
window.Pagination = Pagination;

FilePond.registerPlugin( FilePondPluginImagePreview, FilePondPluginImageCrop );
window.Alpine = Alpine;
window.FilePond = FilePond;
Alpine.start();
