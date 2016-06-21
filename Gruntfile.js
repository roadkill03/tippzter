module.exports = function(grunt) {
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			dist: {
				options: {
					style: 'compressed',
					sourcemap: 'none',
					precision: 2
				},
				files: {
					'css/style.css' : 'scss/style.scss'
				}
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 versions', 'ie 8', 'ie 9']
			},
			dist: {
				files: {
					'css/style.css' : 'css/style.css'
				}
					
			}
		},
		//minifiering
		uglify: {
			build: {
				files: [{
					expand:true,
					src: 'src/js/*.js',
					dest: 'js/',
					flatten: true,
					rename: function(destBase, destPath) {
						return destBase+destPath.replace('.js', '.min.js');
					}
				}]
			}
		},

		watch: {
			css: {
				files: ['**/*.scss'],
				tasks: ['sass', 'autoprefixer']
			},
			js: {
				files: ['src/js/*.js'],
				tasks: ['uglify']
			}
		},

	});
	grunt.registerTask('default', ['watch']);
}