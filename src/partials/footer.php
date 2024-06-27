<footer>
    <p class="m-0 text-center">
        <span class="me-3">Copy &copy 2024 Morning Fruit - Trái Cây Chất Lượng Cao.</span>
        <a href="" class="sn-icon"><i class="mx-2 fa-brands fa-facebook-f"></i></a>
        <a href="" class="sn-icon"><i class="mx-2 fa-brands fa-instagram"></i></a>
        <a href="" class="sn-icon"><i class="mx-2 fa-brands fa-tiktok"></i></a>
    </p>
</footer>

<div class="backtop">
    <i class="fa-solid fa-arrow-up"></i>
</div>

<script>
    $(document).ready(function() {
        var $backToTop = $(".backtop");
        $backToTop.hide(); //Ẩn nút backToTop

        // Bắt sự kiện cuộn trang trên cửa sổ window
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 20) { // Nếu cuộn xuống 1 khoảng cách >20 pixel thì nút backToTop sẽ hiện ra
                $backToTop.fadeIn();
            } else { // Ngược lại thì sẽ ẩn đi
                $backToTop.fadeOut();
            }
        });

        // Bắt sự kiện click của nút backToTop
        $backToTop.on('click', function(e) {
            $("html, body").animate({scrollTop: 0}, //cuộn lên đầu trang trong 500ms
                                     500);
        });
    })
</script>