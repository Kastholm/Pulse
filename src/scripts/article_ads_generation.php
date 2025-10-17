<?php
//Function to create dynamic ad units in articles
function insert_article_adunit_script() {
    if(is_singular('post')){
        ?>
    <script>
        const ad_unit_site = "23209726049/OpdateretDK";
        const is_mobile = window.innerWidth < 576;
		//Define CSS selector where article ad units should be displayed.
		const selector = ".articleText > :not(div):not(h2):not(h3):not(h1)";
		const elements = document.querySelectorAll(selector)
		let plcCounter = 0
		//Function to create an article element
		function insertElement(value, type) {
            div = document.createElement('div');
			//div.style = 'margin:0 auto;';
            div.classList.add(type)
			div.setAttribute("ad-id", value)
/*             if (elements[plcCounter - 1].tagName !== 'H1' && elements[plcCounter - 1].tagName !== 'H2' && elements[plcCounter - 1].tagName !== 'H3') {
                const newLine = document.createElement('br')
                elements[plcCounter - 1].parentNode.insertBefore(newLine, elements[plcCounter])
            } */
			elements[plcCounter].parentNode.insertBefore(div, elements[plcCounter])
			plcCounter += elements[plcCounter].innerText.length < 400 ? 3 : 2;
		}
        
        const placements = {
            "Article_1": `${ad_unit_site}/Article_1`,
            "Article_2": `${ad_unit_site}/Article_2`,
            "Article_3": `${ad_unit_site}/Article_3`,
            "Article_4": `${ad_unit_site}/Article_3`,
            "Article_5": `${ad_unit_site}/Article_3`,
            "Article_6": `${ad_unit_site}/Article_3`,
            "Mobile_Article_1": `${ad_unit_site}/Mobile_Article_1`,
            "Mobile_Article_2": `${ad_unit_site}/Mobile_Article_2`,
            "Mobile_Article_3": `${ad_unit_site}/Mobile_Article_3`,
            "Mobile_Article_4": `${ad_unit_site}/Mobile_Article_3`,
            "Mobile_Article_5": `${ad_unit_site}/Mobile_Article_3`,
            "Mobile_Article_6": `${ad_unit_site}/Mobile_Article_3`
        }
        
		//Loop igennem de placements som er valgt ovenfor - om mobile eller desktop annoncer
        for (const [key, value] of Object.entries(placements)) {
            if (is_mobile && key.includes('Mobile_Article')) {
                insertElement(value, 'mobile')
            } else if(!is_mobile && !key.includes('Mobile') && key.includes('Article')) {
                insertElement(value, 'desktop')
            }
        }
        
        </script>
        <?php
    }
}
add_action('wp_footer', 'insert_article_adunit_script');