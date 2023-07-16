<script>
var hostUrl = '{{ url("/") }}';       
function isNumberKey(evt) {
    if (evt.which == 101 || evt.which == 46 || evt.which == 69 || evt.which == 45 || evt.which == 43) {
        evt.preventDefault();
    }
}
 


</script>
  
    <script src="{{ url('/') }}/assets/plugins/global/plugins.bundle.js"></script>
    <script src="{{ url('/') }}/assets/js/scripts.bundle.js"></script>
    <script src="{{ url('/') }}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="{{ url('/') }}/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
    <script src="{{ url('/') }}/assets/lib/5/index.js"></script>
    <script src="{{ url('/') }}/assets/lib/5/xy.js"></script>
    <script src="{{ url('/') }}/assets/lib/5/percent.js"></script>
    <script src="{{ url('/') }}/assets/lib/5/radar.js"></script>
    <script src="{{ url('/') }}/assets/lib/5/themes/Animated.js"></script>
    <script src="{{ url('/') }}/assets/js/widgets.bundle.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/apps/chat/chat.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/create-project/type.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/create-project/budget.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/create-project/settings.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/create-project/team.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/create-project/targets.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/create-project/files.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/create-project/complete.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/create-project/main.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/new-address.js"></script>
    <script src="{{ url('/') }}/assets/js/custom/utilities/modals/users-search.js"></script>