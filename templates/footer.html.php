    <!-- Stopka -->
    <footer class="footer fixed-bottom bg-dark text-light text-center main-footer pt-3">
        {if !isset($smarty.session.user)}
        <p>Projekt zespołowy - 2018</p>
        {else}
        <p>Panel administratora - 2018</p>
        {/if}
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/js/jquery.min.js"></script>
    <script src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/js/bootstrap.bundle.min.js"></script>

</body>

</html>