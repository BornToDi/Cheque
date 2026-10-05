document.addEventListener('DOMContentLoaded', function () {
  var menu = document.querySelector('[data-open-menu]');
  function closeMenu() { document.body.classList.remove('menu-open'); if (menu) menu.setAttribute('aria-expanded', 'false'); }
  if (menu) menu.addEventListener('click', function () { var open = document.body.classList.toggle('menu-open'); menu.setAttribute('aria-expanded', String(open)); });
  var scrim = document.querySelector('[data-close-menu]'); if (scrim) scrim.addEventListener('click', closeMenu);
  document.addEventListener('keydown', function (event) { if (event.key === 'Escape') closeMenu(); });
  var toggle = document.querySelector('[data-password-toggle]');
  if (toggle) toggle.addEventListener('click', function () { var field = document.getElementById('login-password'); var show = field.type === 'password'; field.type = show ? 'text' : 'password'; toggle.textContent = show ? 'Hide' : 'Show'; toggle.setAttribute('aria-pressed', String(show)); });
  document.querySelectorAll('.legacy-content table').forEach(function (table) {
    if (table.classList.contains('modern-table') || table.querySelector('table') || table.closest('.panel') || table.closest('.zpcCalendar')) return;
    var rows = Array.from(table.rows);
    if (rows.length < 3 || !rows.some(function (row) { return row.cells.length >= 4; })) return;
    var headerIndex = rows.findIndex(function (row) { return row.cells.length >= 4 && (row.querySelector('td.cat, td.subcat, th') || /account|status|customer|branch/i.test(row.textContent)); });
    if (headerIndex < 0) return;
    table.classList.add('workflow-data');
    var wrapper = document.createElement('div'); wrapper.className = 'workflow-scroll'; table.parentNode.insertBefore(wrapper, table); wrapper.appendChild(table);
    var dataRows = rows.slice(headerIndex + 1).filter(function (row) { return row.cells.length >= 4 && !row.querySelector('input:not([type=checkbox]):not([type=radio]),select,textarea,button') && row.textContent.trim(); });
    if (dataRows.length < 3) return;
    var tools = document.createElement('div'); tools.className = 'table-tools';
    var label = document.createElement('label'); label.textContent = 'Filter this list';
    var input = document.createElement('input'); input.type = 'search'; input.placeholder = 'Name, branch or request...'; input.setAttribute('aria-label', 'Filter visible table rows'); label.appendChild(input); tools.appendChild(label);
    var count = document.createElement('span'); count.setAttribute('aria-live', 'polite'); count.textContent = dataRows.length + ' rows on this page'; tools.appendChild(count); wrapper.parentNode.insertBefore(tools, wrapper);
    input.addEventListener('input', function () { var term = input.value.toLowerCase().trim(); var visible = 0; dataRows.forEach(function (row) { var match = row.textContent.toLowerCase().indexOf(term) !== -1; row.hidden = !match; if (match) visible++; }); count.textContent = visible + ' of ' + dataRows.length + ' rows on this page'; });
  });
  document.querySelectorAll('.workflow-data td').forEach(function (cell) {
    if (cell.children.length) return;
    var text = cell.textContent.trim().toLowerCase();
    if (['pending', 'ordered', 'delivered', 'dispatched', 'approval', 'reject'].indexOf(text) === -1) return;
    var badge = document.createElement('span'); badge.className = 'status-badge ' + text; badge.textContent = cell.textContent.trim(); cell.textContent = ''; cell.appendChild(badge);
  });
});
