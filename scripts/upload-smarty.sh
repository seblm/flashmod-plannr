#!/bin/sh

cd ..
ftp -N scripts/netrc ftpperso.free.fr <<EOF 2>&1
prompt off

cd flashmob
mkdir lib
cd lib
lcd lib
mkdir Smarty-2.6.26
cd Smarty-2.6.26
lcd Smarty-2.6.26
ascii
put Config_file.class.php
put debug.tpl
put Smarty_Compiler.class.php
put Smarty.class.php
mkdir internals
cd internals
lcd internals
put core.assemble_plugin_filepath.php
put core.assign_smarty_interface.php
put core.create_dir_structure.php
put core.display_debug_console.php
put core.get_include_path.php
put core.get_microtime.php
put core.get_php_resource.php
put core.is_secure.php
put core.is_trusted.php
put core.load_plugins.php
put core.load_resource_plugin.php
put core.process_cached_inserts.php
put core.process_compiled_include.php
put core.read_cache_file.php
put core.rm_auto.php
put core.rmdir.php
put core.run_insert_handler.php
put core.smarty_include_php.php
put core.write_cache_file.php
put core.write_compiled_include.php
put core.write_compiled_resource.php
put core.write_file.php
mkdir ../plugins
cd ../plugins
lcd ../plugins
put block.textformat.php
put compiler.assign.php
put function.assign_debug_info.php
put function.config_load.php
put function.counter.php
put function.cycle.php
put function.debug.php
put function.eval.php
put function.fetch.php
put function.html_checkboxes.php
put function.html_image.php
put function.html_options.php
put function.html_radios.php
put function.html_select_date.php
put function.html_select_time.php
put function.html_table.php
put function.mailto.php
put function.math.php
put function.popup.php
put function.popup_init.php
put modifier.capitalize.php
put modifier.cat.php
put modifier.count_characters.php
put modifier.count_paragraphs.php
put modifier.count_sentences.php
put modifier.count_words.php
put modifier.date_format.php
put modifier.debug_print_var.php
put modifier.default.php
put modifier.escape.php
put modifier.indent.php
put modifier.lower.php
put modifier.nl2br.php
put modifier.regex_replace.php
put modifier.replace.php
put modifier.spacify.php
put modifier.string_format.php
put modifier.strip.php
put modifier.strip_tags.php
put modifier.truncate.php
put modifier.upper.php
put modifier.wordwrap.php
put outputfilter.trimwhitespace.php
put shared.escape_special_chars.php
put shared.make_timestamp.php

bye
EOF

