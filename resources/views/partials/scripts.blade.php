
<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/i18n/es.js') }}"></script>
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="{{ asset('js/dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>


{{-- ===================== Template ===================== --}}

{{--
<script src="{{ asset('template/js/lib/jquery.min.js') }}"></script>
--}}
<!-- jquery vendor -->
<script src="{{ asset('template/js/lib/jquery.nanoscroller.min.js') }}"></script>
<!-- nano scroller -->
<script src="{{ asset('template/js/lib/menubar/sidebar.js') }}"></script>
<script src="{{ asset('template/js/lib/preloader/pace.min.js') }}"></script>
<!-- sidebar -->
<script src="{{ asset('template/js/lib/bootstrap.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('template/js/lib/weather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('template/js/lib/weather/weather-init.js') }}"></script>
<script src="{{ asset('template/js/lib/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('template/js/lib/circle-progress/circle-progress-init.js') }}"></script>
<script src="{{ asset('template/js/lib/chartist/chartist.min.js') }}"></script>
<script src="{{ asset('template/js/lib/chartist/chartist-init.js') }}"></script>
<script src="{{ asset('template/js/lib/sparklinechart/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('template/js/lib/sparklinechart/sparkline.init.js') }}"></script>
<script src="{{ asset('template/js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('template/js/lib/owl-carousel/owl.carousel-init.js') }}"></script>
<script src="{{ asset('template/js/scripts.js') }}"></script>

@yield('js')