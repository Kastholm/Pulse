<?php
function insert_websail_ad_script() {
    ?>
    <script async>
    window.googletag = window.googletag || { cmd: [] };
    console.log('googletag ✅', window.googletag);

    googletag.cmd.push(function () {
        googletag.pubads().enableSingleRequest();

        document.querySelectorAll('[ad-id]').forEach((el, i) => {
            const ad_path = el.getAttribute('ad-id')
            console.log(ad_path)
            const divId = 'gpt-slot-' + i;
            el.id = divId;
            const sizes = [[300, 250], [728, 90], [320, 50]];
            const slot = googletag.defineSlot(ad_path, sizes, divId);
            console.log('el', el);
            if (!slot) return;
            slot.addService(googletag.pubads());
            googletag.display(divId);
        });
        googletag.enableServices();
    });

    </script>
    <?php
}
add_action('wp_footer', 'insert_websail_ad_script');
?>