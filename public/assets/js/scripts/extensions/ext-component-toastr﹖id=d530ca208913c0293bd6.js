$((function () {
    "use strict";
    var t, o = "rtl" === $("html").attr("data-textdirection"), n = $("#type-success"), i = $("#type-info"),
        s = $("#type-warning"), a = $("#type-error"), e = $("#position-top-left"), r = $("#position-top-center"),
        c = $("#position-top-right"), l = $("#position-top-full"), u = $("#position-bottom-left"),
        h = $("#position-bottom-center"), m = $("#position-bottom-right"), d = $("#position-bottom-full"),
        f = $("#progress-bar"), p = $("#clear-toast-btn"), k = $("#fast-duration"), w = $("#slow-duration"),
        y = $("#timeout"), b = $("#sticky"), g = $("#slide-toast"), I = $("#fade-toast");
    n.on("click", (function () {
        toastr.success("👋 Jelly-o macaroon brownie tart ice cream croissant jelly-o apple pie.", "Success!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o
        })
    })), i.on("click", (function () {
        toastr.info("👋 Chupa chups biscuit brownie gummi sugar plum caramels.", "Info!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o
        })
    })), s.on("click", (function () {
        toastr.warning("👋 Icing cake pudding carrot cake jujubes tiramisu chocolate cake.", "Warning!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o
        })
    })), a.on("click", (function () {
        toastr.error("👋 Jelly-o marshmallow marshmallow cotton candy dessert candy.", "Error!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: o
        })
    })), f.on("click", (function () {
        toastr.success("👋 Chocolate oat cake jelly oat cake candy jelly beans pastry.", "Progress Bar", {
            closeButton: !0,
            tapToDismiss: !1,
            progressBar: !0,
            rtl: o
        })
    })), p.on("click", (function () {
        t || (t = toastr.info('Ready for the vacation?<br /><br /><button type="button" class="btn btn-info btn-sm clear">Yes</button>', "Family Trip", {
            closeButton: !0,
            timeOut: 0,
            extendedTimeOut: 0,
            tapToDismiss: !1,
            rtl: o
        })), t.find(".clear").length && t.delegate(".clear", "click", (function () {
            toastr.clear(t, {force: !0}), t = void 0
        }))
    })), e.on("click", (function () {
        toastr.info("I do not think that word means what you think it means.", "Top Left!", {
            positionClass: "toast-top-left",
            rtl: o
        })
    })), r.on("click", (function () {
        toastr.info("I do not think that word means what you think it means.", "Top Center!", {
            positionClass: "toast-top-center",
            rtl: o
        })
    })), c.on("click", (function () {
        toastr.info("I do not think that word means what you think it means.", "Top Right!", {
            positionClass: "toast-top-right",
            rtl: o
        })
    })), l.on("click", (function () {
        toastr.info("I do not think that word means what you think it means.", "Top Full Width!", {
            positionClass: "toast-top-full-width",
            rtl: o
        })
    })), u.on("click", (function () {
        toastr.info("I do not think that word means what you think it means.", "Bottom Left!", {
            positionClass: "toast-bottom-left",
            rtl: o
        })
    })), h.on("click", (function () {
        toastr.info("I do not think that word means what you think it means.", "Bottom Center!", {
            positionClass: "toast-bottom-center",
            rtl: o
        })
    })), m.on("click", (function () {
        toastr.info("I do not think that word means what you think it means.", "Bottom Right!", {
            positionClass: "toast-bottom-right",
            rtl: o
        })
    })), d.on("click", (function () {
        toastr.info("I do not think that word means what you think it means.", "Bottom Full Width!", {
            positionClass: "toast-bottom-full-width",
            rtl: o
        })
    })), k.on("click", (function () {
        toastr.success("Have fun storming the castle!", "Fast Duration", {showDuration: 500, rtl: o})
    })), w.on("click", (function () {
        toastr.warning("Have fun storming the castle!", "Slow Duration", {hideDuration: 3e3, rtl: o})
    })), y.on("click", (function () {
        toastr.error("I do not think that word means what you think it means.", "Timeout!", {timeOut: 5e3, rtl: o})
    })), b.on("click", (function () {
        toastr.info("I do not think that word means what you think it means.", "Sticky!", {timeOut: 0, rtl: o})
    })), g.on("click", (function () {
        toastr.success("I do not think that word means what you think it means.", "Slide Down / Slide Up!", {
            showMethod: "slideDown",
            hideMethod: "slideUp",
            timeOut: 2e3,
            rtl: o
        })
    })), I.on("click", (function () {
        toastr.success("I do not think that word means what you think it means.", "Slide Down / Slide Up!", {
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            timeOut: 2e3,
            rtl: o
        })
    }))
}));
