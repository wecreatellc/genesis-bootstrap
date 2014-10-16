# Genesis Bootstrap Theme

Github project link: https://github.com/zlanich/genesis-bootstrap

Genesis Bootstrap is a project aiming to combine some of the best web technologies into one boilerplate theme  
for the Genesis Theme Framework for Wordpress. This theme is intended to be modified, extended, etc.

Genesis Bootstrap attempts to use the following technologies:

1. [Bootstrap 3][bootstrap3] - HTML, CSS, and JS framework
2. [LESS.js][less] - CSS pre-processor
3. [SMACSS][smacss] - Scalable and Modular Architecture for CSS
4. [KSS][kss] - Knyle Style Sheets


## Installation Instructions

1. Upload the Genesis Bootstrap theme folder via FTP to your wp-content/themes/ directory.  
    (The Genesis parent theme needs to be in the wp-content/themes/ directory as well.)
2. Go to your WordPress dashboard and select Appearance.
3. Activate the Genesis Bootstrap theme.
4. Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.

## Compiled Workflow

Genesis Bootstrap uses a compiled workflow, meaning it uses LESS instead of native CSS. We chose to use "Gulp"   
to handle compilation and task management.

### GULP Build Process
*Using "[LESS][less]" instead of CSS*

This theme uses a "compiled workflow", meaning that some files (mainly LESS files) will need compiled into another
language (ie. CSS) before being used on the web. An example of this is our choice to use "LESS" instead of "CSS". LESS allows us
to use variables, functions (called mixins) and many other powerful features in our CSS. You will find all of the LESS
files in the **genesis_bootstrap/less/** folder. The syntax for LESS is a superset of the CSS language, therefore you can use
normal css syntax in LESS files, but if you know the LESS syntax, feel free to use it where appropriate.

In order to use the LESS styles you places in any of the LESS files in **genesis_bootstrap/less/**, you must "compile" your LESS
files into CSS and upload the compiled css file(s) along with your modified LESS files to your web server. Compiled
files are located in the **genesis_bootstrap/css/** folder and should always have a ".compiled.css" suffix for clarity. The only files present
in this folder (at the time of writing) are as follows:

* **style.compiled.css** - The main stylesheet, compiled from the majority of the less files in **genesis_bootstrap/less/**

Stylesheets with the ".compiled.css" suffix should **never** be directly edited, as running the compile (aka. build)
process will overwrite any changes made by hand to these files.

### How do I compile these LESS files?

This theme has been set up with a "build process" using [Node.js][node], and [Gulp.js][gulp]. This build process must
be set up on the computer you're developing on. Please follow these steps to get all dependencies installed on your
computer:

1. [Download and install Node.js][node] for your operating system
2. Open your terminal (mac/linux) or command prompt (windows)
3. Change your directory to the "wp-content" folder for the LTBP Website Files on your computer (ie. $ your_terminal: **cd /path/to/wp-content/**)
4. Run command: **npm install** - This will install all required Node.js modules using the package.json file in the **wp-content** folder

**You should now have all required dependencies installed. Here's how to use them:**

After all dependencies are installed, you can now run the task commands provided in the **wp-content/gulpfile.js** file.
The following commands are available at the time of writing:

1. **gulp** - Compiles all LESS files
2. **gulp watch** - Turns on a "File Watcher" that automagically runs the compile task when you save LESS files.

The suggested method is to use the **gulp watch** command. Before you open up your code editor to begin editing your
website, **cd** to the **wp-content** directory (as mentioned in step 2 of the installation instructions above) and run
**gulp watch**. This will continuously watch files and automatically compile them for you until you press **Ctrl + c** in
the command line to cancel it.

### References:
[Less.js - Learn more about the LESS language][less]

[Node.js - Learn more about & download Node.js][node]

[Gulp.js - Learn more about the Gulp.js build tool][gulp]

[less]: http://lesscss.org/ "Learn more about Less.js"
[node]: http://nodejs.org/download/ "Learn more about Node.js"
[gulp]: http://gulpjs.com/ "Learn more about Gulp.js"

## Other Theme Assets

Theme assets such as **Bootstrap** and other Javascript libraries that aren't included with Wordpress are managed using
[Bower Package Manager][bower] when possible, and configured to be installed into the **genesis_bootstrap/vendor/assets/** folder.
Additional libraries can be located on [Bower.io][bower]'s online repository and added to the Genesis Bootstrap theme by editing the
**genesis_bootstrap/bower.json** file and running the **bower install** command in your terminal (NOTE: please **cd** into
the **wp-content/genesis_bootstrap** folder before running **bower install**).

If Bower.io does not have the library you're looking for, you can download your library and place it in the **genesis_bootstrap/vendor/assets/**
folder by hand or follow Bower's guidelines on pulling straight from a git repository.

**Other Notes:** Bootstrap automatically pulls in jQuery as a dependency when using Bower, but we use Wordpress's built-in  
jQuery library, so you can feel free to delete jQuery out of the **vendor/assets** folder if you'd like.

### References:
[Bower.io - Learn more about Bower.io][bower]

[bower]: http://bower.io/ "Learn more about Bower Package Manager"

## Syntax/Coding Guideline Notes

Genesis Bootstrap attempts to follow the following the general guidelines of the following technologies:

1. [Bootstrap 3][bootstrap3] - HTML, CSS, and JS framework
2. [LESS.js][less] - CSS pre-processor
3. [SMACSS][smacss] - Scalable and Modular Architecture for CSS
4. [KSS][kss] - Knyle Style Sheets

Transitioning Genesis's CSS, amongst other things of course was/is not a straight forward task, so it will be an  
ongoing process. Genesis's CSS for example follows a mobile-last approach and is certainly not modular, so most of  
the SMACSS styles you'll see will be added on ui elements and not so much Genesis's existing styles until we have  
a chance to completely re-write Genesis's base styles.

[bootstrap3]: http://getbootstrap.com/ "Learn more about Bootstrap 3"
[less]: http://lesscss.org/ "Learn more about Less.js"
[smacss]: https://smacss.com/ "Learn more about SMACSS"
[kss]: http://warpspire.com/kss/ "Learn more about KSS"

## Disclaimer

This theme is an imperfect, ongoing project and feedback is welcome.