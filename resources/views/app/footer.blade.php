
<footer>
    <ul class="navbar-nav">
        <li>
            <a href="{{ route("home") }}"><i class="fas fa-home"></i>Home</a>
        </li>
        <li>
            <a href="{{ route("boards") }}"><i class="fas fa-tag"></i>Boards</a>
        </li>
        <li>
            <a href="{{ route("boards.sfw") }}"><i class="fas fa-briefcase"></i>SFW boards</a>
        </li>
        <li>
            <a href="{{ route("boards.nsfw") }}"><i class="fas fa-hand-paper"></i>NSFW boards</a>
        </li>
        <li>
            <a href="#"><i class="fas fa-sign-in-alt"></i>Login</a>
        </li>
    </ul>
</footer>



<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/app.min.js') }}"></script>
<script src="{{ asset('/js/main.js') }}"></script>
</body>

</html>