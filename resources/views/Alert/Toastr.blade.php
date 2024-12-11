<script type="text/javascript">
    $(window).on('load', function() {
        @if($errors->any())
            toastr.error("{{ implode($errors->all()) }}", "Ops!", {
                closeButton: !0,
                tapToDismiss: !1,
                timeOut: 1250,
            })
        @endif
        @if(Session::get('success'))
            toastr.success("{{ Session::get('success') }}", "Great!", {
                closeButton: !0,
                tapToDismiss: !1,
                timeOut: 1250,
            })
        @endif
    })
</script>
