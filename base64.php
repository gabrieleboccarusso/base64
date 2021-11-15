<html>

	<head>
		<title> Base64 </title>
		<style>
			.left {
				width: 45%;
				float: left;
				padding-left: 20px;
			}
			.right {
				width: 45%;
				float: right;
				padding-left: 20px;
			}
		</style>
	</head>

	<body>
		<h1> Base 64 hashing algorithm </h1>
		<h2> by Gabriele Boccarusso Industries - software department </h2>

		<section class="left">
			<label> String to encode: </label>
			<input type="text" name="encodethis" id="encodethis">
			<input type="button" value="convert" onclick="encode(encodethis.value);">

			<br>

			<output id = "output_encode" for="encodethis">
			</output>
		</section>

		<section class="right">
			<label> String to decode: </label>
			<input type="text" name="decodethis" id="decodethis">
			<input type="button" value="convert" onclick="decode(decodethis.value);">

			<br>

			<output id = "output_decode" for="decodethis">
			</output>
		</section>

	</body>

	<script>
		let chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
		let output_en = document.getElementById("output_encode");
		let output_de = document.getElementById("output_decode");
		
		function encode(input) {
			output_en.appendChild(document.createTextNode(input + ' => ' + encode64(input)));
			output_en.appendChild(document.createElement('br'));
		}

		function decode(input) {
			output_de.appendChild(document.createTextNode(input + ' => ' + decode64(input)));
			output_de.appendChild(document.createElement('br'));
		}

		function showOutput(oldText, newText) {
			// innerHTML is not advised although being the fastest
			let output = document.getElementById("out");
			output.appendChild(document.createTextNode(oldText + ' => ' + newText + ' => ' + decode64(newText)));
			output.appendChild(document.createElement('br'));
		}

		function makeBinary(input) {
			let output = '';
			let currChar = '';

			for (let i = 0; i < input.length; i++)
			{
				currChar = input[i].charCodeAt(0).toString(2);
				currChar = adjustToString(currChar, 8);
				output += currChar;
			}
			return output;
		}

		function encode64(input) {
			input = makeBinary(input);
			let output = '';
			let n = 0;
			let i;
			for(i = 0; i < input.length; i+=6) {
				n = input.slice(i, i+6);
				if (n.length < 6) {
					n = n + '0'.repeat(6-n.length);
				}
				n = parseInt(n, 2);
				output += chars[n];
			}
			output += '='.repeat(i - input.length);
			return output;
		}

		function adjustToString(binaryStr, bit) {
			let output = '';
			if (binaryStr.length < bit) {
				output = '0'.repeat(bit - binaryStr.length) + binaryStr;
			} else {
				output = binaryStr;
			}
			return output;
		}

		function decode64(input) {
			let char = '';
			let temp, i, n;
			let output = '';
			let ending = '';
			for (i = 0; i < input.length; i++) {
				if (input[i] == '=') {
					ending += '0';
				} else {
					temp = chars.indexOf(input[i]).toString(2);
					char += adjustToString(temp, 6);
				}
			}
			char = char+ending;
			for (i = 0; i < char.length; i+=8) {
				n = parseInt(char.slice(i, i+8), 2);
				output += String.fromCharCode(n);
			}

			return output;
		}
	</script>
</html>