
## Build a github gh-pages
common-build@gh-page:
	mkdir -p docs;
	echo "---" > docs/index.md;
	echo "layout: default" >> docs/index.md;
	echo "---" >> docs/index.md;
	cat README.md  >> docs/index.md;
	mkdir -p docs/_layouts;
	cp -f $(CURRENT_DIR)/vendor/gpupo/common/Resources/gh-pages-template/default.html docs/_layouts/
	cp -f $(CURRENT_DIR)/vendor/gpupo/common/Resources/gh-pages-template/_config.yml docs/;
