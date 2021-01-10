<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<!--<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>-->

<script src="controllers/traitement.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


<script src="js/jquery.timego.js"></script>
<script>
    // French
    jQuery.timeago.settings.strings = {
        // environ ~= about, it's optional
        prefixAgo: "il y a",
        prefixFromNow: "d'ici",
        seconds: "moins d'une minute",
        minute: "une minute",
        minutes: "%d minutes",
        hour: "une heure",
        hours: "%d heures",
        day: "un jour",
        days: "%d jours",
        month: "un mois",
        months: "%d mois",
        year: "un an",
        years: "%d ans"
    };


    jQuery(document).ready(function() {
        $("time.timeago").timeago();
    });
</script>