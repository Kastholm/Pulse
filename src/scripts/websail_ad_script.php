<?php
function insert_websail_ad_script() {
    $ad_units = json_decode(file_get_contents(get_template_directory() . '/src/scripts/ad_units.json'), true);
    if(!$ad_units) {
        ?><script>console.log('JSON file with ad unit sizes not found');</script><?php
        return;
    }
    ?>
    <script async>
    window.googletag = window.googletag || { cmd: [] };
    console.log('googletag ✅', window.googletag);
    console.log('ad_units', <?php echo json_encode($ad_units) ?>);
    const ad_units = <?php echo json_encode($ad_units) ?>;
    googletag.cmd.push(function () {
        googletag.pubads().enableSingleRequest();

        document.querySelectorAll('[ad-id]').forEach((el, i) => {
            const ad_path = el.getAttribute('ad-id')
            const ad_name = ad_path.replace('/23209726049/OpdateretDK/', '')
            console.log(ad_name)
            const div_id = 'gpt-slot-' + i;
            el.id = div_id;
            const find_ad_sizes = ad_units[ad_name]
            if(!find_ad_sizes) {
                return
            }
            console.log(JSON.stringify(find_ad_sizes))
            const slot = googletag.defineSlot(ad_path, find_ad_sizes, div_id);
            console.log('el', el);
            if (!slot) {
                console.log('No ad slot found')
                return;
            } 
            slot.addService(googletag.pubads());
            googletag.display(div_id);
        });
        googletag.enableServices();
    });

    </script>
    <?php
}
add_action('wp_footer', 'insert_websail_ad_script');
?>