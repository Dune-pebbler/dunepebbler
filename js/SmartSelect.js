/**
 * @description
 * This wil create an advanced custom select.
 *
 * @author
 * Raphael Meijer <raphael@dunepebbler.nl>
 */
jQuery.fn.smartSelect = function (options, id) {
  var defaults = {
    element: jQuery(this),
    defaultText: "",
    closeText: "Close <span class='bigger'>&times;</span>",
    appendSelected: false,
    noOptionsText: "No options have been found.",
    isMultiple: jQuery(this).prop('multiple'),
    hasSearch: false,
    hasLayers: false
  };

  // We are gonna build this in a class way :)
  var selectClass = {
    create: function (options) {
      var element = options.element;
      var container = element.parent();
      var noDuplicates = [];

      // Destroy element first!
      this.destroy(element);
      // Hide the select.
      element.hide();
      // Create a button where our start value is stored in
      container.append("<button type='button' class='as-button-toggle'>" + options.defaultText + "</button>");
      // Create a field where more selects go
      if (options.appendSelected) {
        container.append("<div class='as-selected-values'></div>");
      }
      // Create a listing where we store our selects
      container.append("<ul class='as-option-listing'></ul>");
      //Check if we have search option
      if (options.hasSearch) {
        container.find('ul').append("<li class='search'><input type='text' placeholder='Search...'/></li>");
      }
      // Copy the selects to that place.
      if (element.find('optgroup').length > 0) {
        // We have to think what we do here!
        //element.find().each(function(){});
      } else if (element.find('option').length > 0) {
        this.populate(container, element.find('option').not('[value=""]'));
      } else {
        // No elements! Give a message :)
        container.find('ul').append("<p> " + options.noOptionsText + " </p>");
      }

      // append div for clearing of floats.
      container.find('ul').append('<div class="clear"></div>');

      // Select the values needed 
      this.select(element.val());

      // Get selected text
      if (this.options.defaultText == '' && container.find('select option').first().val() == '') {
        this.options.defaultText = container.find('select option').first().val()
      }

      // Set selected text
      if (element.val()) {
        var savedText = "";

        // Show the selected elements
        container.find('.selected').text((index, content) => {
          savedText += "<span>" + content + "</span>"
        });

        container.find('.as-button-toggle').html(savedText);
      }

      // Start adding listeners
      this.createEvents(options);
    },
    select: function (id) {
      var element = this.options.element;
      var values = element.val();
      var container = element.parent();

      // Check if we have a valid id.
      if (id == null || typeof id == 'undefined') {
        return;
      }

      if (this.options.isMultiple) {
        // Check if we have an array
        values = (values == null) ? [] : values;

        // Set values
        if (typeof id === 'object') {
          for (key in id) {
            values.push(id[key]);
          }
        } else {
          values.push(id);
        }

        // Set value to selected div
        if (typeof values == 'object') {
          for (key in values) {
            if (!container.find('.as-option-listing li[data-val="' + values[key] + '"]').hasClass('selected') && values[key] != '') {
              container.find('.as-selected-values').append("<a href='" + values[key] + "'>" + element.find('option[value="' + values[key] + '"]').text() + "</a>");
              // Set class
              container.find('.as-option-listing li[data-val="' + values[key] + '"]').addClass('selected');

              // Set listener
              container.find('.as-selected-values a').last().on('click', function (e) {
                e.preventDefault();

                selectClass.deselect(jQuery(this).attr('href'));
              });
            }
          }
        }

        // Keep the select open
      } else {
        // Check if we can use this.
        if (typeof id != 'number' && typeof id != 'string') {
          throw new Error("Unsupported type of 'id' on single select. Type:" + typeof id);
        }

        // Make sure we have only this one
        container.find('.as-option-listing li').removeClass('selected');
        // Remove the options aswell
        container.find('.as-selected-values a').remove();
        // Set class
        container.find('.as-option-listing li[data-val="' + id + '"]').addClass('selected');
        // Append to listing
        container.find('.as-selected-values').append("<a href='" + id + "'>" + element.find('option[value="' + id + '"]').text() + "</a>");
        // Set listener
        container.find('.as-selected-values a').last().on('click', function (e) {
          e.preventDefault();

          selectClass.deselect(jQuery(this).attr('href'));
        });

        // Set value
        values = id;

        // Close the select
        container.find('.as-button-toggle').click();
      }

      // Set the current val as the val in the select
      element.val(values);

      // Trigger events
      element.trigger('change');
    },
    deselect: function (id) {
      var element = this.options.element;
      var container = element.parent();
      var values = element.val();

      if (this.options.isMultiple) {
        // Check if we have an array
        values = (values == null) ? [] : values;
        // Set value to selected div
        if (typeof id == 'object') {
          for (key in id) {
            if (container.find('.as-option-listing li[data-val="' + id[key] + '"]').hasClass('selected')) {
              var search_value = values.indexOf(id[key]);
              container.find('.as-selected-values a[href="' + id[key] + '"]').remove();
              // Set class
              container.find('.as-option-listing li[data-val="' + id[key] + '"]').removeClass('selected');
              // Remove values
              values.splice(search_value, 1);
            }
          }
        } else {
          var search_value = values.indexOf(id);
          // Remove values
          values.splice(search_value, 1);
          // Remove value from selected div
          container.find('.as-selected-values a[href="' + id + '"]').remove();
          // Remove class
          container.find('.as-option-listing li[data-val="' + id + '"]').removeClass('selected');
          // Keep the select open	
        }
      } else {
        // Remove class
        container.find('.as-option-listing li[data-val="' + id + '"]').removeClass('selected');
        // Remove value from selected div
        container.find('.as-selected-values a[href="' + id + '"]').remove();
        // Set empty value
        values = '';

        // Close the select
        container.find('.as-button-toggle').click();
      }

      // Set the current val as the val in the select
      element.val(values);

      // Trigger events
      element.trigger('change');
    },
    createEvents: function (options) {
      // Set options 
      this.options = options;

      this.listeners(options);
    },
    listeners: function (options) {
      var element = options.element;
      var container = element.parent();
      var selectClass = this;
      var ignore_el = {};

      // set toggle listeners
      container.find('.as-button-toggle').on('click', function () {
        var ulElement = jQuery(this).parent().find('ul.as-option-listing');

        //  The listing will always be at this position
        ulElement.toggle();

        // Check if it open or not.
        if (ulElement.is(':visible')) {
          // Change button!
          jQuery(this).html(options.closeText);
          jQuery(this).addClass('open');

          ulElement.css('top', '100%');
        } else {
          // Reset button!
          if (ulElement.find('.selected').length > 0) {
            var savedText = "";

            // Show the selected elements
            ulElement.find('.selected').text((index, content) => {
              savedText += "<span>" + content + "</span>"
            });
            jQuery(this).html(savedText);
            jQuery(this).removeClass('open');
          } else {
            jQuery(this).html(options.defaultText);
            jQuery(this).removeClass('open');
          }
        }
      });

      /**
       * CHANGE LISTENER	
       */

      container.find('.as-option-listing li').on('click', function (e) {
        // Ignore the parent listeners, if there are some
        e.stopPropagation();

        if (!jQuery(this).hasClass('disabled')) {
          var value = jQuery(this).data('val');

          // Add these to ignore
          ignore_el = jQuery(this).parents('li');

          // We can handle te select/deselect within our class!
          if (jQuery(this).hasClass('selected')) {
            selectClass.deselect(value);

            // Let's find children which we have to deselect!
            jQuery(this).find('li').each(function () {
              selectClass.deselect(jQuery(this).data('val'));
            });
          } else {
            selectClass.select(value);

            // Let's find parents which we have to select!
            jQuery(this).parents('li').each(function () {
              selectClass.select(jQuery(this).data('val'));
            });
          }
        }
      });

      /**
       * Search LISTENER	
       */
      container.find('.as-option-listing input').on('keyup', function () {
        var listing = jQuery(this).parents('ul');
        var value = jQuery(this).val().toLowerCase();

        // Loop through listing
        listing.find('li').not('.search').each(function () {
          if (jQuery(this).text().toLowerCase().indexOf(value) > -1) {
            jQuery(this).show();
          } else {
            jQuery(this).hide();
          }
        });
      });
    },
    populate: function (container, items, noDuplicates) {
      var selectClass = this;
      var itemsToSplice = [];

      items.each(function (i, e) {
        var is_disabled = jQuery(this).prop('disabled') ? " disabled " : "";

        if (typeof jQuery(this).attr('data-childof') != 'undefined') {
          var parent_id = jQuery(this).data('childof');

          // Set reference!
          selectClass.options.hasLayers = true;

          // Add class to our listing
          container.find('ul.as-option-listing').addClass('layered');

          //Check if we have to create a list.
          if (container.find('ul.as-option-listing li[data-val="' + parent_id + '"] ul').length == 0) {
            // Add class for reference
            container.find('ul.as-option-listing li[data-val="' + parent_id + '"]').addClass('has-children');

            // Append the UL aswell
            container.find('ul.as-option-listing li[data-val="' + parent_id + '"]').append('<ul></ul>');
          }
          if (container.find('ul.as-option-listing li[data-val="' + jQuery(this).val() + '"]').length == 0) {
            container.find('ul.as-option-listing li[data-val="' + parent_id + '"] ul').first().append("<li class='" + is_disabled + "' data-val='" + jQuery(this).val() + "' data-childof='" + parent_id + "'> " + jQuery(this).text() + " </li>");
          }
        } else {
          if (container.find('ul.as-option-listing li[data-val="' + jQuery(this).val() + '"]').length == 0) {
            container.find('ul.as-option-listing').append("<li class='" + is_disabled + " top-layer' data-val='" + jQuery(this).attr('value') + "'> " + jQuery(this).text() + " </li>");
          }
        }

        // Add a check if the item is ACTUALLY added!
        if (container.find('ul.as-option-listing li[data-val="' + jQuery(this).val() + '"]').length > 0) {
          itemsToSplice.push(i);
        }

        if (container.find('li').last().find('.circle').length == 0)
          container.find('li').last().prepend(jQuery(this).attr('data-html'));
      });

      // Remove the items!
      for (var i = 0; i < itemsToSplice.length; i++) {
        // remove items which we don't need
        items.splice(itemsToSplice[i], 1);
      }

      if (items.length > 0 && itemsToSplice.length > 0) {
        this.populate(container, items);
      }
    },
    destroy: function () {
      var element = defaults.element;
      var container = element.parent();
      var elements = [".as-button-toggle", ".as-selected-values", ".as-option-listing"];

      // Remove all the elements.
      for (var i = 0; i < elements.length; i++) {
        container.find(elements[i]).remove();
      }

      // Show the previous select again
      element.show();
    },
    init: function (options, id) {
      if (typeof options === 'string') {
        this.options = defaults;
        // We have to call a function within ourself :)
        this[options](id);
      } else if (typeof options === 'object' || typeof options === 'undefined' || !options) {
        options = jQuery.extend(defaults, options);
        this.options = options;

        // We have to create!
        this.create(options);
      } else {
        // Throw error please :) user tries to do something that is not allowed!
        throw new Error('Unknown type of variable "Options".');
      }
    }
  }

  // Init our class
  selectClass.init(options, id);
}