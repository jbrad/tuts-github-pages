module.exports = function(grunt){

    grunt.initConfig({
        sass: {
            dist: {
                options: {
                    style: 'compressed',
                    noCache: true
                },
                files: {
                    'style.css': 'css/sass/style.scss'
                }
            }
        },

        concat: {
            bootstrap: {
                src: [
                    'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/transition.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/alert.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/button.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/carousel.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/collapse.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/dropdown.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/modal.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tooltip.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/popover.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/scrollspy.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tab.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/affix.js'
                ],
                dest: 'js/dev/bootstrap.js'
            }
        },

        uglify: {
            dist: {
                files: {
                    'js/theme.min.js': ['js/dev/*.js']
                }
            }
        },

        watch: {
            sass: {
                files: 'css/sass/*.scss',
                tasks: 'sass'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', 'sass');
}