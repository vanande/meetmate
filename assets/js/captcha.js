

// puzzles configuration
let puzzles = [];
let colums = 3;
let rows = 3;
let w, h;

// L'ordre du puzzles
let board = [];
let actualTile;
let otherThile; //le tile vide

//var imgOrder = ["1","2","3","4","5","6","7","8","9"];
var imgOrder = ["4", "2", "8", "5", "1", "6", "7", "9", "3"];

window.onload = function(){
  for (let i = 0; i < rows; i++) {
    for (let j = 0; j < colums; j++) {
      
      let tile = document.createElement("img");
      tile.id = i.toString() + "-" + j.toString();
      tile.src ="assets/img_captcha/" + imgOrder.shift() + ".jpg";

      //DRAG FUNCTIONALITY
      tile.addEventListener("dragstart", dragStart);  //click an image to drag
      tile.addEventListener("dragover", dragOver);    //moving image around while clicked
      tile.addEventListener("dragenter", dragEnter);  //dragging image onto another one
      tile.addEventListener("dragleave", dragLeave);  //dragged image leaving anohter image
      tile.addEventListener("drop", dragDrop);        //drag an image over another image, drop the image
      tile.addEventListener("dragend", dragEnd);      //after drag drop, swap the two tiles

      document.getElementById("board").append(tile);

      }
    }
    if(isSolved){
      header("Location : profil.php");
    }
}

function dragStart() {
    currTile = this; //this refers to the img tile being dragged
}

function dragOver(e) {
    e.preventDefault();
}

function dragEnter(e) {
    e.preventDefault();
}

function dragLeave() {

}

function dragDrop() {
    otherTile = this; //this refers to the img tile being dropped on
}

function dragEnd() {
    if (!otherTile.src.includes("3.jpg")) {
        return;
    }

    let currCoords = currTile.id.split("-"); //ex) "0-0" -> ["0", "0"]
    let r = parseInt(currCoords[0]);
    let c = parseInt(currCoords[1]);

    let otherCoords = otherTile.id.split("-");
    let r2 = parseInt(otherCoords[0]);
    let c2 = parseInt(otherCoords[1]);

    let moveLeft = r == r2 && c2 == c-1;
    let moveRight = r == r2 && c2 == c+1;

    let moveUp = c == c2 && r2 == r-1;
    let moveDown = c == c2 && r2 == r+1;

    let isAdjacent = moveLeft || moveRight || moveUp || moveDown;

    if (isAdjacent) {
        let currImg = currTile.src;
        let otherImg = otherTile.src;

        currTile.src = otherImg;
        otherTile.src = currImg;

        turns += 1;
        document.getElementById("turns").innerText = turns;
    }
      
    }
  

function isSolved(){
  let count = 1;
  for (let i = 0; i < rows; i++) {
    for (let j = 0; j < colums; j++) {
      
      let tile = getElementById("img"+i+"-"+j);
      if(tile.src !== "http://localhost:8888/temp_finale/assets/img_captcha/" +count + ".jpg"){
        return false;
      }
      count++;
    }
  }
  return true;
}



























// // Charger l'image
// function preload() {
//   let source;
//   source = loadImage("assets/img/aigle.png");
// }

// function setup() {
//   let canvas = document.getElementById("myCanvas");
//   let ctx = canvas.getContext("2d");

//   ctx.loadImage("assets/img/aigle.png");
 
//   // dimensions des cases du puzzle
//   w = width / colums;
//   h = height / rows;
  
//   // Découpez l'image source en puzzles
//   for (let i = 0; i < colums; i++) {
//     for (let j = 0; j < rows; j++) {
//       let x = i * w;
//       let y = j * h;
//       let img = createImage(w, h);
//       ctx.img.copy(source, x, y, w, h, 0, 0, w, h);
//       let index = i + j * colums; //04812 4,8,12,16 8,12,16,20
//       board.push(index);
//       let puzzle = new Tile(index, img);
//       puzzles.push(puzzle);
//     }
//   }
  
//   // Remove the last puzzle
//   puzzles.pop();
//   board.pop();
//   // -1 means empty spot
//   board.push(-1);
  
//   // Shuffle the board
//   simpleShuffle(board);
// }

// // Swap two elements of an array
// function swap(i, j, arr) {
//   let temp = arr[i];
//   arr[i] = arr[j];
//   arr[j] = temp;
// }

// // Pick a random spot to attempt a move
// // This should be improved to select from only valid moves
// function randomMove(arr) {
//   let r1 = floor(random(colums));
//   let r2 = floor(random(rows));
//   move(r1, r2, arr);
// }

// // Shuffle the board
// function simpleShuffle(arr) {
//   for (let i = 0; i < 100; i++) {
//     randomMove(arr);
//   }
// }

// // Move based on click
// function mousePressed() {
//   let i = floor(mouseX / w);
//   let j = floor(mouseY / h);
//   move(i,j,board);
// }



// function draw() {
//   background(0);

//   // Draw the current board
//   for (let i = 0; i < colums; i++) {
//     for (let j = 0; j < rows; j++) {
//       let index = i + j * colums;
//       let x = i * w;
//       let y = j * h;
//       let puzzleIndex = board[index];
//       if (puzzleIndex > -1) {
//         let img = puzzles[puzzleIndex].img;
//         image(img, x, y, w, h);
//       }
//     }
//   }
  
//   // Show it as grid
//   for (let i = 0; i < colums; i++) {
//     for (let j = 0; j < rows; j++) {
//       let x = i * w;
//       let y = j * h;
//       strokeWeight(2);
//       noFill();
//       rect(x, y, w, h);
//     }
//   }
  
//   // dès que c'est résolu
//   if (isSolved()) {
//     header("Location : profil.php");
//   }
// }

// // Vérification de si c'est résolu
// function isSolved() {
//   for (let i = 0; i < board.length-1; i++) {
//     if (board[i] !== puzzles[i].index) {
//       return false;
//     }
//   }
//   return true;
// }

// // Swap two pieces
// function move(i, j, arr) {
//   let blank = findBlank();
//   let blankCol = blank % colums;
//   let blankRow = floor(blank / rows);
  
//   // Double check valid move
//   if (isNeighbor(i, j, blankCol, blankRow)) {
//     swap(blank, i + j * colums, arr);
//   }
// }

// // Check if neighbor
// function isNeighbor(i, j, x, y) {
//   if (i !== x && j !== y) {
//     return false;
//   }

//   if (abs(i - x) == 1 || abs(j - y) == 1) {
//     return true;
//   }
//   return false;
// }


// // Probably could just use a variable
// // to track blank spot
// function findBlank() {
//   for (let i = 0; i < board.length; i++) {
//     if (board[i] == -1) return i;
//   }
// }
