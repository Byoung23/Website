<div class="aios-shortcode">
    <!-- BEGIN: Row Box -->
    <div class="wpui-row wpui-row-box">
        <div class="wpui-col-md-3">
            <p><span class="wpui-settings-title">Settings</span></p>
        </div>
        <div class="wpui-col-md-9">
            <p class="mt-0"><strong>Directories</strong></p>
            <p>Directories are defined relative to your theme folder. They must be separate from one another, so you cannot define the root folder to compile into itself.</p>
            <p>Ideally you should setup a scss folder and a css folder within your theme. This will ensure the most accurate compiling.</p>
            <pre class="mb-5"><code class="d-block py-2 px-3">aios-stater-theme-child
    |-css
    |  --style.css
    |  --ie.css
    |-scss
    |  --style.scss
    |  --ie.scss</code></pre>

            <p><strong>Compiling Mode</strong></p>
            <p>Compiling comes in five modes:</p>
            <ul>
                <li>Expanded - Full open css. One line per property. Brackets close on their own line.</li>
                <li>Nested - Lightly compressed css. Brackets close with css block. Indents to match scss nesting.</li>
                <li>Compressed - More compressed css. Entire rule block on one line. No indentation.</li>
                <li>Compact - Removes all line breaks, unnecessary whitespace, and single-line comments.</li>
                <li>Crunched - Same as Compressed, but also removes multi-line comments.</li>
            </ul>

            <p><strong>Source Map Mode</strong></p>
            <p>Source maps come in three modes:</p>
            <ul>
                <li>None - No source map will be generated.</li>
                <li>Inline - A source map will be generated in the compiled CSS file.</li>
                <li>File - A source map will be generated as a standalone file in the compiled CSS directory.</li>
            </ul>

            <p><strong>Error Display</strong></p>
            <p>If you're working on a live/production site, you can send errors to a log. This will create a log file in your scss directory and print errors there as they occur. Just keep an eye on it, because the css will not be updated until errors have been resolved.</p>
            <p>Error display come in three modes:</p>
            <ul>
                <li>Show | Show in logged in users - 'Show in Header' will post a message on the front end when errors have occured.</li>
                <li>Hide - Don't display error</li>
            </ul>

        </div>
    </div>
    <!-- END: Row Box -->
    <!-- BEGIN: Row Box -->
    <div class="wpui-row wpui-row-box">
        <div class="wpui-col-md-3">
            <p><span class="wpui-settings-title">Directions</span></p>
        </div>
        <div class="wpui-col-md-9">
            <p class="mt-0"><em>This plugin requires at least php 5.4 to work.</em></p>
            <p><strong>Importing Subfiles</strong></p>
            <p>You can import other scss files into parent files and compile them into a single css file. To do this, use @import as normal in your scss file. All imported file names must start with an underscore. Otherwise they will be compiled into their own css file.</p>
            <p>When importing in your scss file, you can leave off the underscore.</p>
            <pre class="mb-5"><code class="d-block py-2 px-3">@import 'subfile';</code></pre>
            <p><strong>Setting Variables via PHP</strong></p>
            <p>You can set SCSS variables in your theme or plugin by using the wp_scss_variables filter.</p>
            <pre class="mb-5"><code class="d-block py-2 px-3">function wp_scss_set_variables(){
    $variables = array(
        'black' => '#000',
        'white' => '#fff'
    );
    return $variables;
}
add_filter('wp_scss_variables','wp_scss_set_variables');</code></pre>
            <p><strong>Compass Support</strong></p>
            <p>Currently there isn't a way to fully support compass with a php compiler. If you want limited support, you can manually import the compass framework. You'll need both the _compass.scss and compass directory.</p>
            <pre><code class="d-block py-2 px-3">compass / frameworks / compass / stylesheets /
@import 'compass';</code></pre>
        </div>
    </div>
    <!-- BEGIN: Row Box -->
    <div class="wpui-row wpui-row-box">
        <div class="wpui-col-md-3">
            <p class="mt-0"><span class="wpui-settings-title">Support</span></p>
        </div>
        <div class="wpui-col-md-9">
            <p>This plugin will only work with <strong>.scss</strong> format.</p>
        </div>
    </div>
    <!-- END: Row Box -->
</div>