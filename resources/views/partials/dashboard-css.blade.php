<style>
    .navbar-bg {
        background-color: #{{ $color }}
    }
    .btn-primary, .btn-primary.disabled {
        background-color: #{{ $color }};
        border-color: #{{ $color }};
    }
    .nav-pills .nav-item .nav-link.active {
        background-color: #{{ $color }};
    }
    .nav-pills .nav-item .nav-link {
        color: #{{ $color }};
    }
    .list-group-item.active {
        background-color: #{{ $color }};
    }
    .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #{{ $color }};
        border-color: #{{ $color }};
    }
    a {
        color: #{{ $color }};
    }
    .btn-primary, .btn-primary.disabled {
        background-color: #{{ $color }};
        border-color: #{{ $color }};
    }
    .btn-primary:active, .btn-primary:hover, .btn-primary.disabled:active, .btn-primary.disabled:hover {
        background-color: #{{ $color }} !important;
    }
    .card.card-primary {
        border-top: 2px solid #{{ $color }};
    }
</style>
