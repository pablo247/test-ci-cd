# Asset Architecture for DST Multisitios Template

## Table of contents

- [Description](#description)
	- [Technologies](#technologies)
- [How to use](#how-to-use)
- [License](#license)

---

## Description
Scalable architecture to use in any project.

### Technologies
- SASS
- JS
- Node
- NPM
- Webpack

---

## How to use

The files to modify are in the src folder.

If the .env file does not exist, You must copy and rename .env.example file.

If you want to change the dist folder, You must modify the variables in the .env file.
- CSS_DIST_FILENAME: Put css file name
- CSS_DIST_FOLDER: Put the path to the css file
- JS_DIST_FILENAME: Put js file name
- JS_DIST_FOLDER: Put the path to the js file

If node_modules folder does not exist, You need to run the following command:
```sh
npm install
```

Run the following commands to compile code:

The command compiles only once
```sh
npm run build
```

The command waits for changes
```sh
npm run watch
```

---

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
