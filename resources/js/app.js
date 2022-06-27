/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require('./bootstrap');*/

// window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* const app = new Vue({
    el: '#app',
}); */

// Function for sorting table content
function sortTable(n) {
    let table, rows, switching, i, x, xVal, y, yVal, shouldSwitch, dir, switchCount = 0;
    table = document.getElementById("table");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            xVal = (x.textContent === parseInt(x.textContent).toString()) ? parseInt(x.textContent) : x.textContent.toLowerCase();
            yVal = (y.textContent === parseInt(y.textContent).toString()) ? parseInt(y.textContent) : y.textContent.toLowerCase();
            if (dir === "asc") {
                if (xVal > yVal) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir === "desc") {
                if (xVal < yVal) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchCount ++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchCount === 0 && dir === "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

$(document).ready(function() {
    let $window = $(window);

    $('.form-control').each(function(){
        if($(this).val().trim() != "") {
            $(this).addClass('has-val');
        }
        
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    });

    const toast = $(".toast");
    if (toast.length) {
        toast.addClass("active");
        setTimeout(function () {
            toast.remove();
        }, 5000);
    }

    const nav = $('.navigation');
    $('#toggleMenu').on('click', function() {
        if (nav.css('display') == 'block') {
            nav.hide();
        } else {
            nav.show();
        }
    });
    
    let width = $window.width();
    if (width > 998) {
        $("#ownerButton").remove();
    }

    $(".table").each(function () {
        // Add search input
        $(this).before("<div class='table-search'><label for='tableSearchInput'>Search:</label><input type='text' id='tableSearchInput'></div>");
    
        // Search in table
        $("#tableSearchInput").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $(".table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    
        // Add sorting buttons
        let th = $(this).find("th");
        let thNumber = th.length;
        th.each(function (i) {
            $(this).append("<a href='#' id='sort_" + i + "'><span class='material-icons'>unfold_more</span></a>");
            $("#sort_" + i).on("click", function () {
                sortTable(i);
            });
        });
    });
});

