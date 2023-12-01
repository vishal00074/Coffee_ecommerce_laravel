<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            &copy; {{date('Y')}}. <p> Made with <i class="icon-heart5 text-danger"></i> by <span class="text-danger">Coffee</span></p>
        </span>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.sidebar-mobile-main-toggle').on('click', function() {
        $('.sidebar-content').toggleClass('visible');
    });
});
</script>
<!-- /footer -->