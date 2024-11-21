let result = document.getElementById("result");

function appendNumber(number) {
  result.value += number;
}

function appendOperator(operator) {
  if (result.value.length > 0) {
    result.value += operator;
  }
}

function clearDisplay() {
  result.value = "";
}

function deleteLast() {
  result.value = result.value.slice(0, -1);
}

function calculateResult() {
  try {
    result.value = eval(result.value.replace('÷', '/').replace('×', '*'));
  } catch {
    result.value = "Error";
  }
}
