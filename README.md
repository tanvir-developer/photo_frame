# Photo Frame Editor

A simple web-based photo frame editor.Users can upload photos, select from available frames, and preview their images with frames applied.


## Technologies Used
- PHP
- JavaScript
- HTML5 Canvas
- jQuery


## Features

- Upload your own photo (JPG, PNG)
- Choose from multiple frame styles
- Preview your photo with the selected frame
- Responsive canvas preview
- Uses HTML5 Canvas for rendering (with FlashCanvas fallback for older browsers)
- Simple UI with Bootstrap styling

## Project Structure

```
action.php
index.php
fr1.png
fr2.png
fr3.png
js/
  frame.js
  flashcanvas/
    canvas2png.js
    flashcanvas.js
    flash10canvas.swf
    flash9canvas.swf
    save.php
resources/
  jquery.contextmenu/
    jquery.contextMenu.css
    jquery.contextMenu.js
    images/
      ...
upload/
  *_thump.jpg/png
```

## Requirements

- PHP 5.4+ (for image processing and session handling)
- Web server (e.g., Apache, Nginx, XAMPP)
- Modern browser (HTML5 Canvas support; Flash required for very old browsers)

## Installation

1. Clone or download the repository : git clone https://github.com/tanvir-developer/photo_frame_editor 
2. Ensure the `upload/` directory is writable by the web server.
3. Open `index.php` in your browser.

## Usage

1. Enter your desired photo width and height.
2. Upload a photo or select an existing one from the gallery.
3. Choose a frame style.
4. Preview your framed photo on the canvas.

## Notes

- Uploaded images are resized and stored in the `upload/` directory.
- Only JPG and PNG images are supported.
- Frame images (`fr1.png`, `fr2.png`, `fr3.png`) can be replaced or extended as needed.

## Screenshot
<img width="1080" height="566" alt="image" src="https://github.com/user-attachments/assets/fb450395-a9c8-4497-a438-04c1b5381e7b" />
