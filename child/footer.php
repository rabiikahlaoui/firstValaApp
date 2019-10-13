<footer class="page-footer bg-dark text-white font-small blue mt-4">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="https://evaste.com"> Evaste</a>
    </div>
</footer>
<?php wp_footer();?>

<script type="text/javascript" id="init-script">
            jQuery(function() {
                // quick search regex
                var qsRegex;
                var buttonFilter;

                // init Isotope
                var $container = jQuery('.isotope').isotope({
                    itemSelector: '.element-item',
                    layoutMode: 'masonry'
                });

                var $container_button = jQuery('.isotope-button');

                var cat_all = '0';

                if (cat_all == '1') {
                    $container.isotope({
                        filter: '.vikser'
                    });
                    jQuery('.button-group').each(function(i, buttonGroup) {
                        var $buttonGroup = jQuery(buttonGroup);
                        $buttonGroup.find('.is-checked').removeClass('is-checked');
                        jQuery('[class^="button"][class$="vikser"]').addClass('is-checked');
                    });
                } else {
                    jQuery('.button-group').each(function(i, buttonGroup) {
                        var $buttonGroup = jQuery(buttonGroup);
                        $buttonGroup.find('.is-checked').removeClass('is-checked');
                        jQuery('[class^="button"][class$="all"]').addClass('is-checked');
                    });
                }


                $container_button.isotope();

                // use value of search field to filter
                var $quicksearch = jQuery('#quicksearch').keyup(debounce(function() {
                    qsRegex = new RegExp($quicksearch.val(), 'gi');
                    $container.isotope({
                        filter: function() {
                            var $this = jQuery(this);
                            var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
                            var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                            return searchResult && buttonResult;
                        }
                    });
                }));

                // bind filter button click
                jQuery('#filters').on('click', 'li', function() {
                    var filterValue = jQuery(this).attr('data-filter');
                    $container.isotope({
                        filter: filterValue
                    });

                    if (filterValue != '') {
                        var category_name = jQuery('#append-more').attr('class').split(' ').pop();
                        jQuery('#append-more').removeClass(category_name);
                        jQuery('#append-more').addClass(filterValue.substring(1, filterValue.length));
                    }

                    var listCat = [];

                    listCat.push(["vikser", 36]);
                    listCat.push(["autres", 4]);
                    listCat.push(["helpers", 4]);
                    listCat.push(["plugin-library", 7]);
                    listCat.push(["shortcodes", 9]);
                    listCat.push(["woocommerce", 6]);
                    listCat.push(["wordpress", 11]);
                    for (var i = 0; i < listCat.length; i++) {
                        if (listCat[i][0] == filterValue.substring(1, filterValue.length)) var nombre_article = listCat[i][1];
                    }

                    if (nombre_article == jQuery('.col-md-4.element-item:visible').length) {
                        jQuery('#button-more').hide();
                        jQuery('.isotope-button').css('height', '0px');
                    } else {
                        jQuery('#button-more').show();
                        $container_button.isotope();
                    }
                });

                // change is-checked class on buttons
                jQuery('.button-group').each(function(i, buttonGroup) {
                    var $buttonGroup = jQuery(buttonGroup);
                    $buttonGroup.on('click', 'button', function() {
                        $buttonGroup.find('.is-checked').removeClass('is-checked');
                        jQuery(this).addClass('is-checked');
                    });
                });

                jQuery('#append-more').on('click', function() {
                    jQuery('#icon-more').attr('class', 'fa fa-spinner fa-pulse');
                    var category_name = jQuery('#append-more').attr('class').split(' ').pop();
                    var listPost = [];
                    jQuery(".post-id").each(function() {
                        listPost.push(jQuery(this).attr('class').split(' ').pop());
                    });
                    var category_parent = "vikser";
                    jQuery.post(
                        ajaxurl, {
                            'action': 'load_more',
                            'category_name': category_name,
                            'listPost': listPost,
                            'category_parent': category_parent
                        },
                        function(response) {
                            if (response) {
                                var $elems = jQuery(response);
                                var $container = jQuery('.isotope');
                                $container.append($elems).isotope('appended', $elems);
                                jQuery('#icon-more').attr('class', 'fa fa-plus');
                            } else {
                                jQuery('#icon-more').attr('class', 'fa fa-plus');
                            }

                            var listCat = [];

                            listCat.push(["vikser", 36]);
                            listCat.push(["autres", 4]);
                            listCat.push(["helpers", 4]);
                            listCat.push(["plugin-library", 7]);
                            listCat.push(["shortcodes", 9]);
                            listCat.push(["woocommerce", 6]);
                            listCat.push(["wordpress", 11]);
                            for (var i = 0; i < listCat.length; i++) {
                                if (listCat[i][0] == category_name) var nombre_article = listCat[i][1];
                            }

                            if (nombre_article == jQuery('.col-md-4.element-item:visible').length) {
                                jQuery('#button-more').hide();
                                jQuery('.isotope-button').css('height', '0px');
                            }
                        }
                    );
                });
            });

            // debounce so filtering doesn't happen every millisecond
            function debounce(fn, threshold) {
                var timeout;
                return function debounced() {
                    if (timeout) {
                        clearTimeout(timeout);
                    }

                    function delayed() {
                        fn();
                        timeout = null;
                    }
                    setTimeout(delayed, threshold || 100);
                };
            }

        </script>
</body>
</html>
