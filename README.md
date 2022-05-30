# Problems faced

## Integrating Tailwind CSS utility framework

### Problem 1: How to install Tailwind CSS framework

#### Step 1: Install TailWind

```npm install tailwindcss```

#### Step 2: Add Tailwind to your CSS

Add following directives to ```/resources/sass/app.css```. So when you run ```npm run dev```
it includes Tailwind items to the compiled file in ```public/css/app.css```

```
@tailwind base;
@tailwind components;
@tailwind utilities;
```

#### Step 3: Add Tailwind config file 

```npx tailwind init```

This adds tailwind.config.js to root which extends its content to .html, .css., .vue files

#### Step 4: Compile your styles with Laraval Mix

Replace all lines in your webpack.mix.js to:

```
const mix = require('laravel-mix');

const tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    });
```

#### Step 5: Compile

run `npm run dev`
This will execute `npm run develpment -> npm run mix` from `package.json`


