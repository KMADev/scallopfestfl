<input type="hidden" name="formID" value="vendor">
<div class="row">
    <div class="col-md-6">
        <label for="your_name" class="sr-only">Business Name *</label>
        <div class="input-group mb-2 <?php echo( $yourname == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
            <input name="your_name" type="text" id="your_name"
                   class="textbox form-control <?php echo( $yourname == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                   value="<?php echo( ! $passCheck && $yourname != '' ? $yourname : '' ); ?>" required
                   placeholder="Business Name *">
        </div>
    </div>
    <div class="col-md-6">
        <label for="contact_person" class="sr-only">Contact Person *</label>
        <div class="input-group mb-2 <?php echo( $contactperson == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
            <input name="contact_person" type="text" id="contatct_person"
                   class="textbox form-control <?php echo( $contactperson == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                   value="<?php echo( ! $passCheck && $contactperson != '' ? $contactperson : '' ); ?>" required
                   placeholder="Contact Person*">
        </div>
    </div>
    <div class="col-md-4">
        <label for="your_email" class="sr-only">Email Address *</label>
        <div class="input-group mb-2 <?php echo( $youremail == '' && $formSubmitted || $emailformattedbadly ? 'has-danger' : '' ); ?>">
            <input name="your_email" type="text" id="your_email"
                   class="textbox form-control <?php echo( $youremail == '' && $formSubmitted || $emailformattedbadly ? 'form-control-danger' : '' ); ?>"
                   value="<?php echo( ! $passCheck && $youremail != '' ? $youremail : '' ); ?>" required
                   placeholder="Email Address *">
        </div>
    </div>
    <div class="col-md-4">
        <label for="phone" class="sr-only">Phone Number *</label>
        <div class="input-group mb-2 <?php echo( $phone == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
            <input name="phone" type="text" id="phone"
                   class="textbox form-control <?php echo( $phone && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                   value="<?php echo( ! $passCheck && $phone != '' ? $phone : '' ); ?>"
                   placeholder="Phone Number *">
        </div>
    </div>
    <div class="col-md-4">
        <label for="cellphone" class="sr-only">Cell Phone Number *</label>
        <div class="input-group mb-2 <?php echo( $phone == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
            <input name="cellphone" type="text" id="phone"
                   class="textbox form-control <?php echo( $phone && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                   value="<?php echo( ! $passCheck && $phone != '' ? $phone : '' ); ?>"
                   placeholder="Cell Phone Number *">
        </div>
    </div>
    <div class="col-12">
        <label for="website" class="sr-only">Website</label>
        <div class="input-group mb-2">
            <input name="website" type="text" id="contatct_person"
                   class="textbox form-control"
                   value="<?php echo( ! $passCheck && $website != '' ? $website : '' ); ?>"
                   placeholder="Website">
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-8">
        <label for="address" class="sr-only">Address *</label>
        <div class="input-group mb-2 <?php echo( $address == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
            <input name="address" type="text"
                   id="address <?php echo( $address && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                   value="<?php echo( ! $passCheck && $address != '' ? $address : '' ); ?>"
                   class="textbox form-control" required placeholder="Address *">
        </div>
    </div>
    <div class="col-md-4">
        <label for="address_2" class="sr-only">Apt/Suite *</label>
        <div class="input-group mb-2">
            <input name="address_2" type="text" id="address_2" class="textbox form-control"
                   value="<?php echo( ! $passCheck && $address_2 != '' ? $address_2 : '' ); ?>"
                   placeholder="Apt/Suite">
        </div>
    </div>
    <div class="col-md-5">
        <label for="city" class="sr-only">City *</label>
        <div class="input-group mb-2 <?php echo( $city == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
            <input name="city" type="text" id="city"
                   class="textbox form-control <?php echo( $city == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                   value="<?php echo( ! $passCheck && $city != '' ? $city : '' ); ?>" required placeholder="City *">
        </div>
    </div>
    <div class="col-md-4">
        <label for="state" class="sr-only">State *</label>
        <div class="input-group mb-2 <?php echo( $state == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
            <select class="form-control <?php echo( $state == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                    required name="state">
				<?php
				include( locate_template( 'template-parts/content-states.php' ) );
				?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label for="zip" class="sr-only">Zip *</label>
        <div class="input-group mb-2 <?php echo( $zip == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
            <input name="zip" type="text" id="zip"
                   class="textbox form-control <?php echo( $zip == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                   value="<?php echo( ! $passCheck && $zip != '' ? $zip : '' ); ?>" required placeholder="Zip *">
        </div>
    </div>
</div>
<p>&nbsp;</p>
<div class="custom-controls-stacked">

    <label for="booth_type" class="label"><strong>Booth Type<sup>*</sup></strong></label>
    <label class="custom-control custom-radio">
        <input name="booth_type" type="radio" value="Tent" class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Tent</span>
    </label>
    <label class="custom-control custom-radio">
        <input name="booth_type" type="radio" value="Trailer" class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Trailer</span>
    </label>
    <label class="custom-control custom-radio">
        <input name="booth_type" type="radio" value="Other" class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Other</span>
    </label>

</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="describe_booth" class="label">If other, please describe</label>
            <textarea name="describe_booth" rows="4" class="form-control" placeholder="Describe Booth"
                      style="height: 130px;"><?php echo( ! $passCheck && $describeBooth != '' ? stripslashes( $describeBooth ) : '' ); ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="additional_info" class="sr-only">Description: Please list items to be sold</label>
            <textarea name="additional_info" rows="4" class="form-control"
                      placeholder="Please list items to be sold *" required
                      style="height: 130px;"><?php echo( ! $passCheck && $message != '' ? stripslashes( $message ) : '' ); ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <p>Participating vendors shall not market, sell or otherwise distribute items of any type that bear the name
            of "Florida Scallop & Music Festival" without express written consent of the Florida Scallop & Music
            Festival, Inc. Violation will result in immediate non-refundable expulsion.</p>

        <p>Pricing: includes 7% sales tax on the space. All prices shown are based on 12 ft. frontage non-food
            vendors; food vendors - 16 ft frontage. For each additional foot $26.75.</p>
    </div>
</div>
<div class="custom-controls-stacked">
    <label for="booth_type" class="label"><strong>Category*</strong></label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio"
               value="12 ft. frontage Arts and Crafts (no power - $120)" class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Arts and Crafts (no power - $120)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio" value="12 ft. frontage Arts and Crafts (110v - $135)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Arts and Crafts (110v - $135)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio"
               value="12 ft. frontage Commercial Vendors-NO product sales (no power - $175)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Commercial Vendors-NO product sales (no power - $175)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio"
               value="12 ft. frontage Commercial Vendors-NO product sales (110v - $190)" class="custom-control-input"
               required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Commercial Vendors-NO product sales (110v - $190)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio"
               value="12 ft. frontage Commercial Vendors-with product sales (no power - $355)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Commercial Vendors-with product sales (no power - $355)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio"
               value="12 ft. frontage Commercial Vendors-with product sales (110v - $370)" class="custom-control-input"
               required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Commercial Vendors-with product sales (110v - $370)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio" value="16 ft. frontage Food Vendors (no power - $355)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">16 ft. frontage Food Vendors (no power - $355)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio" value="16 ft. frontage Food Vendors (110v - $370)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">16 ft. frontage Food Vendors (110v - $370)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio" value="16 ft. frontage Food Vendors (220v - $455)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">16 ft. frontage Food Vendors (220v - $455)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio" value="16 ft. frontage Snack Vendors (no power - $275)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">16 ft. frontage Snack Vendors (no power - $275)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio" value="16 ft. frontage Snack Vendors (110v - $290)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">16 ft. frontage Snack Vendors (110v - $290)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio"
               value="12 ft. frontage Non-profit - Educational/Churches (no power - $60)" class="custom-control-input"
               required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Non-profit - Educational/Churches (no power - $60)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio"
               value="12 ft. frontage Non-profit - Educational/Churches (110v - $75)" class="custom-control-input"
               required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Non-profit - Educational/Churches (110v - $75)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio" value="12 ft. frontage Political (no power - $120)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Political (no power - $120)</span>
    </label>
    <label class="custom-control custom-radio">
        <input id="radioStacked1" name="vendortype" type="radio" value="12 ft. frontage Political (110v - $135)"
               class="custom-control-input" required>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">12 ft. frontage Political (110v - $135)</span>
    </label>
</div>
<p>For each additional foot - $26.75<br>
    Enter number of additional frontage needed (above the standard 16 ft).</p>
<p>I need an additional <input name="additional_feet" type="text" id="additional_feet"
                               class="form-control col-1"
                               value="<?php echo( ! $passCheck && $additionalFeet != '' ? $additionalFeet : '' ); ?>"
                               placeholder="0" style="display: inline-block;"> feet.

<div class="form-group">
    <input type="text" name="secu"
           style="position: absolute; height: 1px; top: -50px; left: -50px; width: 1px; padding: 0; margin: 0; visibility: hidden;">
    <button type="submit" class="btn btn-primary btn-md mb-2">Submit Application</button>
</div>
